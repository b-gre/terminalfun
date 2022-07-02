# TerminalFun

TerminalFun is a library for user interaction and output styling.

## Documentation

Please find more documentation here:
- [Installation](docs/install.md)
- [Styles](docs/styles.md)
- [Menu](docs/menu.md)

## Basic example

```php
use BGre\TerminalFun\Menu\Menu;
use BGre\TerminalFun\Menu\PlainItem;
use BGre\TerminalFun\Stty;
use BGre\TerminalFun\Style\Formatter;
use BGre\TerminalFun\Terminfo;

// Save the terminal state and restore it when the script exits:
Stty::saveState();
register_shutdown_function([Stty::class, 'restoreState']);

// Set up the terminal to
// -icanon: provide key strokes immediately (instead of only complete lines)
// -echo: do not print the text that the user types
Stty::setState('-icanon', '-echo');

// Terminfo knows the escape sequences to print for color, cursor positioning etc.
// for the specific terminal that the program runs in.
$terminfo = Terminfo::detect();

// Styles for the menu
$formatter = Formatter::fromSheet($terminfo, <<<'END'
    menu:
        - pair: rgb(1 1 1) hsv(0.58 .66 0.3)

    menu focused item:
        - brighter: 0.25 0.25

    menu quickfilter:
        - pair: rgb(1 1 1) hsv(0.33 0.5 0.5)

    END);

// Create a menu
$menu = new Menu($formatter, STDIN, STDERR);
$menu->addItem(new PlainItem('Option one'));
$menu->addItem(new PlainItem('Option two'));

// Run the menu
$selected = $menu->run();

// Print the selected item, if the user confirmed it with Enter (Esc = Cancel)
if ($item instanceof PlainItem) {
    printf('Your choice: %s'.PHP_EOL, $item->getText());
} else {
    printf('Cancelled'.PHP_EOL);
}

```
