<?php

namespace BGre\TerminalFun\Style;

use BGre\TerminalFun\Color\ColorPair;
use BGre\TerminalFun\Color\RGB;
use BGre\TerminalFun\Terminfo;

class Formatter
{
    /** @var Style[] */
    protected array $styles = [];

    protected ColorPair $initialPair;

    final public function __construct(protected Terminfo $terminfo, ?ColorPair $initialPair = null)
    {
        $this->initialPair = $initialPair ?? new ColorPair(new RGB(1, 1, 1), new RGB(0, 0, 0));
    }

    public static function fromSheet(Terminfo $terminfo, string $sheet): static
    {
        $instance = new static($terminfo);
        Sheet::parse($sheet)->applyTo($instance);

        return $instance;
    }

    public function getTerminfo(): Terminfo
    {
        return $this->terminfo;
    }

    public function getInitialPair(): ColorPair
    {
        return $this->initialPair;
    }

    public function setInitialPair(ColorPair $initialPair): static
    {
        $this->initialPair = $initialPair;

        return $this;
    }

    public function getStyles(): array
    {
        return $this->styles;
    }

    public function addStyle(Style $style): static
    {
        $this->styles[] = $style;

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        $this->styles = array_filter(
            $this->styles,
            fn ($s) => $s !== $style
        );

        return $this;
    }

    public function render(string $markup): string
    {
        $parser = xml_parser_create();

        $output = $this->initialPair->render($this->terminfo);

        $effectsStack = new EffectsStack($this->initialPair);

        try {
            xml_set_element_handler(
                $parser,
                function ($parser, $name) use (&$output, $effectsStack) {
                    if ('_' === $name) {
                        return;
                    }

                    $name = strtolower($name);

                    $output .= $effectsStack->enter(
                        $this->terminfo,
                        $name,
                        ...$this->findEffects($name, $effectsStack->getTagStack())
                    );
                },
                function ($parser, $name) use (&$output, &$effectsStack) {
                    if ('_' === $name) {
                        return;
                    }
                    $output .= $effectsStack->leave($this->terminfo);
                }
            );
            xml_set_character_data_handler($parser, function ($parser, $cdata) use (&$output) {
                $output .= $cdata;
            });

            xml_parse($parser, '<_>'.$markup.'</_>', true);

            if (XML_ERROR_NONE !== $xe = xml_get_error_code($parser)) {
                throw new \RuntimeException('XML error: '.xml_error_string($xe)."\n".$markup);
            }
        } finally {
            xml_parser_free($parser);
        }

        $output .= $this->terminfo->origPair();

        return $output;
    }

    protected function findEffects(string $tag, array $parents): array
    {
        $matchingStyles = [];
        foreach ($this->styles as $style) {
            $prio = $style->matchPriority(...[...$parents, $tag]);
            if ($prio > 0) {
                $matchingStyles[$prio][] = $style;
            }
        }

        ksort($matchingStyles);

        $effects = [];

        foreach ($matchingStyles as $a) {
            /** @var Style $style */
            foreach ($a as $style) {
                foreach ($style->getEffects() as $effect) {
                    $effects[] = $effect;
                }
            }
        }

        return $effects;
    }
}
