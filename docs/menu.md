**Table of contents**
- [Menu](#menu)
  - [Position and dimensions](#position-and-dimensions)
  - [Borders](#borders)
  - [Padding](#padding)
  - [Custom Key bindings](#custom-key-bindings)
- [Menu items](#menu-items)
  - [Plain items](#plain-items)
  - [Checkbox items](#checkbox-items)
  - [Radio items](#radio-items)
  - [Data items](#data-items)
    - [Data item display configuration](#data-item-display-configuration)
  - [Dividers](#dividers)
  - [Custom items](#custom-items)
- [Styles](#styles)

# Menu
The `Menu` class is a highly customizable class with sensible defaults.

## Position and dimensions
By default the menu takes as little space as necessary and is displayed with the
top left corner at the current cursor position.

By changing the `offsetTop` and `offsetLeft` properties, the menu can be moved
down and right from the cursor.

Desired exact dimensions can be specified by calling `setWidth()` and/or `setHeight()`.
`setMaximize(truue)` instructs the menu to take up as much space as possible, but limited by
the `maxWidth` and `maxHeight` settings.

See the `menu:submenu`, `menu:files` and `menu:data` commands from the demo project for examples.

## Borders
By default the menu uses double borders from the unicode box drawing block.
All border elements can be customised by manipulating the `Border` object
that can be obtained through the `getBorder()` method.

The `Border` class has a number of convenience functions to set the border elements.

See the `menu:submenu` command from the demo project for an example.

## Padding
Padding adds characters around the menu item inside the menu border.
It can be controlled through the `leftPadding`, `rightPadding`, `focusedLeftPadding`
and `focusedRightPadding` properties.

## Custom Key bindings
You can add your own key bindings and override default bindings with `bindKey()`.
In the key callback you might use `confirm()` or `cancel()` to break from the main menu loop.

See the `menu:submenu` command from the demo project for an example.

If you are unsure how a key combination is represented as string in TerminalFun,
run the `keys` command from the demo project and hit the key combination you need.


# Menu items

## Plain items
A plain item is the simplest and easiest type of a menu item. It contains only plain text.

See the `menu:submenu` command from the demo project for an example.

## Checkbox items
Checkbox items display a check box followed by a lable. The user can use the Space key
to toggle the check box.

See the `menu:submenu` command from the demo project for an example.

## Radio items
Radio items are similar to check box items, but they display a radio in front of the label.
Only one radio item per group can be selected.

Radio items are grouped together by passing the same `ArrayObject` to all items of the same group.

See the `menu:submenu` command from the demo project for an example.

## Data items
Data items can display complex data in the menu. It need the data in the form of
(possibly) nested arrays and a display configuration.

The display configuration can be shared between multiple data items and can be
changed after the creation of the data items. Use `$menu->display()` to refresh the menu
after a change to the display configuration.

### Data item display configuration
The display configuration is maintained in a `DataItemDisplay` object.
It takes a number of displays from the `BGre\TerminalFun\Menu\DataItemDisplay`
namespace (or your custom displays). Available displays are

- StringData: Displays a string value
- BoolData: Displays a string representation for a boolean value
- ArrayData: Concatenates strings from an array and displays it
- Literal: A string literal to display (useful for spacing)

See the `menu:data` command from the demo project for an example.

## Dividers
Dividers visually divide a menu into multiple parts.

See the `menu:submenu` command from the demo project for an example.

## Custom items
You can create your custom item class that implements the
`BGre\TerminalFun\Menu\Item` interface.

# Styles

The default main tag for the menu is `menu`, but can be changed.
Inside there are
- `border` to style the borders
- `quickfilter` for the quick filter
- `focused` for focused lines
- `item` for items

Selectors that can be useful:
```
menu:
menu item:
menu focused item:
menu quickfilter:
```

See [styles](styles.md) For styling details.