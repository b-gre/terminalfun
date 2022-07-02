**Table of contents**
- [Formatting](#formatting)
- [Styles sheets](#styles-sheets)
  - [Selectors](#selectors)
    - [Examples](#examples)
  - [Effects](#effects)
    - [Builtin effects](#builtin-effects)
    - [Custom effects](#custom-effects)

# Formatting

The TerminalFun formatter uses a style sheet approach for formatting.
It takes XML strings and compiles them to terminal sequences using the
effects from the provided style sheet.

# Styles sheets

A style sheet consists of any number of sections, each section starting with a selector followed by a number of effects.

Style sheets are processed line by line, each line is either a selector or an effect or empty.

## Selectors
A selector line contains a comma separated list of selectors, followed by a colon.
Each selector consists of a tag list with at least one tag. Each tag after the
first references a child of the previous tag. Adding a `>` between tags forces
the child to be a direct child of the parent.

All tags must be lower case.

### Examples

**Match tag `b` only if it is a child of tag `a`:**
```
a b:
```
```
<a>...<b>this part is styled</b>...</a>
<a>...<x>...<b>this part is styled</b>...</x>...</a>
```

**Match tag `b` only if it is a direct child of tag `a`:**
```
a > b:
```
```
<a>...<b>this part is styled</b>...</a>
<a>...<x>...<b>this part is NOT styled</b>...</x>...</a>
```

See the `styles` command form the demo project for more examples.

## Effects

An effect line starts with a dash, followed by a space and the name of the effect. Optionally followed by a colon (:) and effect parameters.

Parameters can be numbers or colors. A color can be specified as RGB or HSV color
in the formats `rgb(r g b)` and `hsv(h s v)` where all arguments are numbers between 0 and 1.
For example `rgb(0 1 0)` and `hsv(0 0.333 0)` are both bright green colors.

### Builtin effects
- `pair: color color`
  - set foreground and background color
- `foreground: color`
  - set the foreground color
- `background: color`
  - set the background color
- `brighter: number`
  -  modify the brightness of the parent, values between -1.0 and 1.0
- `hue: number`
  - set the hue, values between 0 and 1
- `saturation: number`
  - set the saturation, values between 0 and 1
- `italic`
  -  make the text italic
- `bold`
  - make the text bold

### Custom effects
You can create custom effect classes that extend
`BGre\TerminalFun\Style\Effects\Effect`.

Once done you can register them through `BGre\TerminalFun\Style\Sheet::registerEffect()`.
