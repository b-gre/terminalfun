<?php

namespace BGre\TerminalFun\Traits;

trait TerminfoFunctions
{
    public function autoLeftMargin(): ?bool
    {
        return $this->bools['auto_left_margin'] ?? null;
    }

    public function autoRightMargin(): ?bool
    {
        return $this->bools['auto_right_margin'] ?? null;
    }

    public function noEscCtlc(): ?bool
    {
        return $this->bools['no_esc_ctlc'] ?? null;
    }

    public function ceolStandoutGlitch(): ?bool
    {
        return $this->bools['ceol_standout_glitch'] ?? null;
    }

    public function eatNewlineGlitch(): ?bool
    {
        return $this->bools['eat_newline_glitch'] ?? null;
    }

    public function eraseOverstrike(): ?bool
    {
        return $this->bools['erase_overstrike'] ?? null;
    }

    public function genericType(): ?bool
    {
        return $this->bools['generic_type'] ?? null;
    }

    public function hardCopy(): ?bool
    {
        return $this->bools['hard_copy'] ?? null;
    }

    public function hasMetaKey(): ?bool
    {
        return $this->bools['has_meta_key'] ?? null;
    }

    public function hasStatusLine(): ?bool
    {
        return $this->bools['has_status_line'] ?? null;
    }

    public function insertNullGlitch(): ?bool
    {
        return $this->bools['insert_null_glitch'] ?? null;
    }

    public function memoryAbove(): ?bool
    {
        return $this->bools['memory_above'] ?? null;
    }

    public function memoryBelow(): ?bool
    {
        return $this->bools['memory_below'] ?? null;
    }

    public function moveInsertMode(): ?bool
    {
        return $this->bools['move_insert_mode'] ?? null;
    }

    public function moveStandoutMode(): ?bool
    {
        return $this->bools['move_standout_mode'] ?? null;
    }

    public function overStrike(): ?bool
    {
        return $this->bools['over_strike'] ?? null;
    }

    public function statusLineEscOk(): ?bool
    {
        return $this->bools['status_line_esc_ok'] ?? null;
    }

    public function destTabsMagicSmso(): ?bool
    {
        return $this->bools['dest_tabs_magic_smso'] ?? null;
    }

    public function tildeGlitch(): ?bool
    {
        return $this->bools['tilde_glitch'] ?? null;
    }

    public function transparentUnderline(): ?bool
    {
        return $this->bools['transparent_underline'] ?? null;
    }

    public function xonXoff(): ?bool
    {
        return $this->bools['xon_xoff'] ?? null;
    }

    public function needsXonXoff(): ?bool
    {
        return $this->bools['needs_xon_xoff'] ?? null;
    }

    public function prtrSilent(): ?bool
    {
        return $this->bools['prtr_silent'] ?? null;
    }

    public function hardCursor(): ?bool
    {
        return $this->bools['hard_cursor'] ?? null;
    }

    public function nonRevRmcup(): ?bool
    {
        return $this->bools['non_rev_rmcup'] ?? null;
    }

    public function noPadChar(): ?bool
    {
        return $this->bools['no_pad_char'] ?? null;
    }

    public function nonDestScrollRegion(): ?bool
    {
        return $this->bools['non_dest_scroll_region'] ?? null;
    }

    public function canChange(): ?bool
    {
        return $this->bools['can_change'] ?? null;
    }

    public function backColorErase(): ?bool
    {
        return $this->bools['back_color_erase'] ?? null;
    }

    public function hueLightnessSaturation(): ?bool
    {
        return $this->bools['hue_lightness_saturation'] ?? null;
    }

    public function colAddrGlitch(): ?bool
    {
        return $this->bools['col_addr_glitch'] ?? null;
    }

    public function crCancelsMicroMode(): ?bool
    {
        return $this->bools['cr_cancels_micro_mode'] ?? null;
    }

    public function hasPrintWheel(): ?bool
    {
        return $this->bools['has_print_wheel'] ?? null;
    }

    public function rowAddrGlitch(): ?bool
    {
        return $this->bools['row_addr_glitch'] ?? null;
    }

    public function semiAutoRightMargin(): ?bool
    {
        return $this->bools['semi_auto_right_margin'] ?? null;
    }

    public function cpiChangesRes(): ?bool
    {
        return $this->bools['cpi_changes_res'] ?? null;
    }

    public function lpiChangesRes(): ?bool
    {
        return $this->bools['lpi_changes_res'] ?? null;
    }

    public function columns(): ?int
    {
        return $this->numbers['columns'] ?? null;
    }

    public function initTabs(): ?int
    {
        return $this->numbers['init_tabs'] ?? null;
    }

    public function lines(): ?int
    {
        return $this->numbers['lines'] ?? null;
    }

    public function linesOfMemory(): ?int
    {
        return $this->numbers['lines_of_memory'] ?? null;
    }

    public function magicCookieGlitch(): ?int
    {
        return $this->numbers['magic_cookie_glitch'] ?? null;
    }

    public function paddingBaudRate(): ?int
    {
        return $this->numbers['padding_baud_rate'] ?? null;
    }

    public function virtualTerminal(): ?int
    {
        return $this->numbers['virtual_terminal'] ?? null;
    }

    public function widthStatusLine(): ?int
    {
        return $this->numbers['width_status_line'] ?? null;
    }

    public function numLabels(): ?int
    {
        return $this->numbers['num_labels'] ?? null;
    }

    public function labelHeight(): ?int
    {
        return $this->numbers['label_height'] ?? null;
    }

    public function labelWidth(): ?int
    {
        return $this->numbers['label_width'] ?? null;
    }

    public function maxAttributes(): ?int
    {
        return $this->numbers['max_attributes'] ?? null;
    }

    public function maximumWindows(): ?int
    {
        return $this->numbers['maximum_windows'] ?? null;
    }

    public function maxColors(): ?int
    {
        return $this->numbers['max_colors'] ?? null;
    }

    public function maxPairs(): ?int
    {
        return $this->numbers['max_pairs'] ?? null;
    }

    public function noColorVideo(): ?int
    {
        return $this->numbers['no_color_video'] ?? null;
    }

    public function bufferCapacity(): ?int
    {
        return $this->numbers['buffer_capacity'] ?? null;
    }

    public function dotVertSpacing(): ?int
    {
        return $this->numbers['dot_vert_spacing'] ?? null;
    }

    public function dotHorzSpacing(): ?int
    {
        return $this->numbers['dot_horz_spacing'] ?? null;
    }

    public function maxMicroAddress(): ?int
    {
        return $this->numbers['max_micro_address'] ?? null;
    }

    public function maxMicroJump(): ?int
    {
        return $this->numbers['max_micro_jump'] ?? null;
    }

    public function microColSize(): ?int
    {
        return $this->numbers['micro_col_size'] ?? null;
    }

    public function microLineSize(): ?int
    {
        return $this->numbers['micro_line_size'] ?? null;
    }

    public function numberOfPins(): ?int
    {
        return $this->numbers['number_of_pins'] ?? null;
    }

    public function outputResChar(): ?int
    {
        return $this->numbers['output_res_char'] ?? null;
    }

    public function outputResLine(): ?int
    {
        return $this->numbers['output_res_line'] ?? null;
    }

    public function outputResHorzInch(): ?int
    {
        return $this->numbers['output_res_horz_inch'] ?? null;
    }

    public function outputResVertInch(): ?int
    {
        return $this->numbers['output_res_vert_inch'] ?? null;
    }

    public function printRate(): ?int
    {
        return $this->numbers['print_rate'] ?? null;
    }

    public function wideCharSize(): ?int
    {
        return $this->numbers['wide_char_size'] ?? null;
    }

    public function buttons(): ?int
    {
        return $this->numbers['buttons'] ?? null;
    }

    public function bitImageEntwining(): ?int
    {
        return $this->numbers['bit_image_entwining'] ?? null;
    }

    public function bitImageType(): ?int
    {
        return $this->numbers['bit_image_type'] ?? null;
    }

    public function backTab(): ?string
    {
        return $this->strings['back_tab'] ?? null;
    }

    public function bell(): ?string
    {
        return $this->strings['bell'] ?? null;
    }

    public function carriageReturn(): ?string
    {
        return $this->strings['carriage_return'] ?? null;
    }

    public function changeScrollRegion(int $top, int $bottom): ?string
    {
        if (!array_key_exists('change_scroll_region', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['change_scroll_region'], $top, $bottom);
    }

    public function clearAllTabs(): ?string
    {
        return $this->strings['clear_all_tabs'] ?? null;
    }

    public function clearScreen(): ?string
    {
        return $this->strings['clear_screen'] ?? null;
    }

    public function clrEol(): ?string
    {
        return $this->strings['clr_eol'] ?? null;
    }

    public function clrEos(): ?string
    {
        return $this->strings['clr_eos'] ?? null;
    }

    public function columnAddress(int $column): ?string
    {
        if (!array_key_exists('column_address', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['column_address'], $column);
    }

    public function commandCharacter(): ?string
    {
        return $this->strings['command_character'] ?? null;
    }

    public function cursorAddress(int $column, int $row): ?string
    {
        if (!array_key_exists('cursor_address', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['cursor_address'], $row, $column);
    }

    public function cursorDown(): ?string
    {
        return $this->strings['cursor_down'] ?? null;
    }

    public function cursorHome(): ?string
    {
        return $this->strings['cursor_home'] ?? null;
    }

    public function cursorInvisible(): ?string
    {
        return $this->strings['cursor_invisible'] ?? null;
    }

    public function cursorLeft(): ?string
    {
        return $this->strings['cursor_left'] ?? null;
    }

    public function cursorMemAddress(): ?string
    {
        return $this->strings['cursor_mem_address'] ?? null;
    }

    public function cursorNormal(): ?string
    {
        return $this->strings['cursor_normal'] ?? null;
    }

    public function cursorRight(): ?string
    {
        return $this->strings['cursor_right'] ?? null;
    }

    public function cursorToLl(): ?string
    {
        return $this->strings['cursor_to_ll'] ?? null;
    }

    public function cursorUp(): ?string
    {
        return $this->strings['cursor_up'] ?? null;
    }

    public function cursorVisible(): ?string
    {
        return $this->strings['cursor_visible'] ?? null;
    }

    public function deleteCharacter(): ?string
    {
        return $this->strings['delete_character'] ?? null;
    }

    public function deleteLine(): ?string
    {
        return $this->strings['delete_line'] ?? null;
    }

    public function disStatusLine(): ?string
    {
        return $this->strings['dis_status_line'] ?? null;
    }

    public function downHalfLine(): ?string
    {
        return $this->strings['down_half_line'] ?? null;
    }

    public function enterAltCharsetMode(): ?string
    {
        return $this->strings['enter_alt_charset_mode'] ?? null;
    }

    public function enterBlinkMode(): ?string
    {
        return $this->strings['enter_blink_mode'] ?? null;
    }

    public function enterBoldMode(): ?string
    {
        return $this->strings['enter_bold_mode'] ?? null;
    }

    public function enterCaMode(): ?string
    {
        return $this->strings['enter_ca_mode'] ?? null;
    }

    public function enterDeleteMode(): ?string
    {
        return $this->strings['enter_delete_mode'] ?? null;
    }

    public function enterDimMode(): ?string
    {
        return $this->strings['enter_dim_mode'] ?? null;
    }

    public function enterInsertMode(): ?string
    {
        return $this->strings['enter_insert_mode'] ?? null;
    }

    public function enterSecureMode(): ?string
    {
        return $this->strings['enter_secure_mode'] ?? null;
    }

    public function enterProtectedMode(): ?string
    {
        return $this->strings['enter_protected_mode'] ?? null;
    }

    public function enterReverseMode(): ?string
    {
        return $this->strings['enter_reverse_mode'] ?? null;
    }

    public function enterStandoutMode(): ?string
    {
        return $this->strings['enter_standout_mode'] ?? null;
    }

    public function enterUnderlineMode(): ?string
    {
        return $this->strings['enter_underline_mode'] ?? null;
    }

    public function eraseChars(int $count): ?string
    {
        if (!array_key_exists('erase_chars', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['erase_chars'], $count);
    }

    public function exitAltCharsetMode(): ?string
    {
        return $this->strings['exit_alt_charset_mode'] ?? null;
    }

    public function exitAttributeMode(): ?string
    {
        return $this->strings['exit_attribute_mode'] ?? null;
    }

    public function exitCaMode(): ?string
    {
        return $this->strings['exit_ca_mode'] ?? null;
    }

    public function exitDeleteMode(): ?string
    {
        return $this->strings['exit_delete_mode'] ?? null;
    }

    public function exitInsertMode(): ?string
    {
        return $this->strings['exit_insert_mode'] ?? null;
    }

    public function exitStandoutMode(): ?string
    {
        return $this->strings['exit_standout_mode'] ?? null;
    }

    public function exitUnderlineMode(): ?string
    {
        return $this->strings['exit_underline_mode'] ?? null;
    }

    public function flashScreen(): ?string
    {
        return $this->strings['flash_screen'] ?? null;
    }

    public function formFeed(): ?string
    {
        return $this->strings['form_feed'] ?? null;
    }

    public function fromStatusLine(): ?string
    {
        return $this->strings['from_status_line'] ?? null;
    }

    public function init1string(): ?string
    {
        return $this->strings['init_1string'] ?? null;
    }

    public function init2string(): ?string
    {
        return $this->strings['init_2string'] ?? null;
    }

    public function init3string(): ?string
    {
        return $this->strings['init_3string'] ?? null;
    }

    public function initFile(): ?string
    {
        return $this->strings['init_file'] ?? null;
    }

    public function insertCharacter(): ?string
    {
        return $this->strings['insert_character'] ?? null;
    }

    public function insertLine(): ?string
    {
        return $this->strings['insert_line'] ?? null;
    }

    public function insertPadding(): ?string
    {
        return $this->strings['insert_padding'] ?? null;
    }

    public function keyBackspace(): ?string
    {
        return $this->strings['key_backspace'] ?? null;
    }

    public function keyCatab(): ?string
    {
        return $this->strings['key_catab'] ?? null;
    }

    public function keyClear(): ?string
    {
        return $this->strings['key_clear'] ?? null;
    }

    public function keyCtab(): ?string
    {
        return $this->strings['key_ctab'] ?? null;
    }

    public function keyDc(): ?string
    {
        return $this->strings['key_dc'] ?? null;
    }

    public function keyDl(): ?string
    {
        return $this->strings['key_dl'] ?? null;
    }

    public function keyDown(): ?string
    {
        return $this->strings['key_down'] ?? null;
    }

    public function keyEic(): ?string
    {
        return $this->strings['key_eic'] ?? null;
    }

    public function keyEol(): ?string
    {
        return $this->strings['key_eol'] ?? null;
    }

    public function keyEos(): ?string
    {
        return $this->strings['key_eos'] ?? null;
    }

    public function keyF0(): ?string
    {
        return $this->strings['key_f0'] ?? null;
    }

    public function keyF1(): ?string
    {
        return $this->strings['key_f1'] ?? null;
    }

    public function keyF10(): ?string
    {
        return $this->strings['key_f10'] ?? null;
    }

    public function keyF2(): ?string
    {
        return $this->strings['key_f2'] ?? null;
    }

    public function keyF3(): ?string
    {
        return $this->strings['key_f3'] ?? null;
    }

    public function keyF4(): ?string
    {
        return $this->strings['key_f4'] ?? null;
    }

    public function keyF5(): ?string
    {
        return $this->strings['key_f5'] ?? null;
    }

    public function keyF6(): ?string
    {
        return $this->strings['key_f6'] ?? null;
    }

    public function keyF7(): ?string
    {
        return $this->strings['key_f7'] ?? null;
    }

    public function keyF8(): ?string
    {
        return $this->strings['key_f8'] ?? null;
    }

    public function keyF9(): ?string
    {
        return $this->strings['key_f9'] ?? null;
    }

    public function keyHome(): ?string
    {
        return $this->strings['key_home'] ?? null;
    }

    public function keyIc(): ?string
    {
        return $this->strings['key_ic'] ?? null;
    }

    public function keyIl(): ?string
    {
        return $this->strings['key_il'] ?? null;
    }

    public function keyLeft(): ?string
    {
        return $this->strings['key_left'] ?? null;
    }

    public function keyLl(): ?string
    {
        return $this->strings['key_ll'] ?? null;
    }

    public function keyNpage(): ?string
    {
        return $this->strings['key_npage'] ?? null;
    }

    public function keyPpage(): ?string
    {
        return $this->strings['key_ppage'] ?? null;
    }

    public function keyRight(): ?string
    {
        return $this->strings['key_right'] ?? null;
    }

    public function keySf(): ?string
    {
        return $this->strings['key_sf'] ?? null;
    }

    public function keySr(): ?string
    {
        return $this->strings['key_sr'] ?? null;
    }

    public function keyStab(): ?string
    {
        return $this->strings['key_stab'] ?? null;
    }

    public function keyUp(): ?string
    {
        return $this->strings['key_up'] ?? null;
    }

    public function keypadLocal(): ?string
    {
        return $this->strings['keypad_local'] ?? null;
    }

    public function keypadXmit(): ?string
    {
        return $this->strings['keypad_xmit'] ?? null;
    }

    public function labF0(): ?string
    {
        return $this->strings['lab_f0'] ?? null;
    }

    public function labF1(): ?string
    {
        return $this->strings['lab_f1'] ?? null;
    }

    public function labF10(): ?string
    {
        return $this->strings['lab_f10'] ?? null;
    }

    public function labF2(): ?string
    {
        return $this->strings['lab_f2'] ?? null;
    }

    public function labF3(): ?string
    {
        return $this->strings['lab_f3'] ?? null;
    }

    public function labF4(): ?string
    {
        return $this->strings['lab_f4'] ?? null;
    }

    public function labF5(): ?string
    {
        return $this->strings['lab_f5'] ?? null;
    }

    public function labF6(): ?string
    {
        return $this->strings['lab_f6'] ?? null;
    }

    public function labF7(): ?string
    {
        return $this->strings['lab_f7'] ?? null;
    }

    public function labF8(): ?string
    {
        return $this->strings['lab_f8'] ?? null;
    }

    public function labF9(): ?string
    {
        return $this->strings['lab_f9'] ?? null;
    }

    public function metaOff(): ?string
    {
        return $this->strings['meta_off'] ?? null;
    }

    public function metaOn(): ?string
    {
        return $this->strings['meta_on'] ?? null;
    }

    public function newline(): ?string
    {
        return $this->strings['newline'] ?? null;
    }

    public function padChar(): ?string
    {
        return $this->strings['pad_char'] ?? null;
    }

    public function parmDch(int $count): ?string
    {
        if (!array_key_exists('parm_dch', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_dch'], $count);
    }

    public function parmDeleteLine(int $count): ?string
    {
        if (!array_key_exists('parm_delete_line', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_delete_line'], $count);
    }

    public function parmDownCursor(int $count): ?string
    {
        if (!array_key_exists('parm_down_cursor', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_down_cursor'], $count);
    }

    public function parmIch(int $count): ?string
    {
        if (!array_key_exists('parm_ich', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_ich'], $count);
    }

    public function parmIndex(int $lines): ?string
    {
        if (!array_key_exists('parm_index', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_index'], $lines);
    }

    public function parmInsertLine(int $count): ?string
    {
        if (!array_key_exists('parm_insert_line', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_insert_line'], $count);
    }

    public function parmLeftCursor(int $count): ?string
    {
        if (!array_key_exists('parm_left_cursor', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_left_cursor'], $count);
    }

    public function parmRightCursor(int $count): ?string
    {
        if (!array_key_exists('parm_right_cursor', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_right_cursor'], $count);
    }

    public function parmRindex(int $lines): ?string
    {
        if (!array_key_exists('parm_rindex', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_rindex'], $lines);
    }

    public function parmUpCursor(int $count): ?string
    {
        if (!array_key_exists('parm_up_cursor', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['parm_up_cursor'], $count);
    }

    public function pkeyKey(): ?string
    {
        return $this->strings['pkey_key'] ?? null;
    }

    public function pkeyLocal(): ?string
    {
        return $this->strings['pkey_local'] ?? null;
    }

    public function pkeyXmit(): ?string
    {
        return $this->strings['pkey_xmit'] ?? null;
    }

    public function printScreen(): ?string
    {
        return $this->strings['print_screen'] ?? null;
    }

    public function prtrOff(): ?string
    {
        return $this->strings['prtr_off'] ?? null;
    }

    public function prtrOn(): ?string
    {
        return $this->strings['prtr_on'] ?? null;
    }

    public function repeatChar(string $char, int $count): ?string
    {
        if (!array_key_exists('repeat_char', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['repeat_char'], $char, $count);
    }

    public function reset1string(): ?string
    {
        return $this->strings['reset_1string'] ?? null;
    }

    public function reset2string(): ?string
    {
        return $this->strings['reset_2string'] ?? null;
    }

    public function reset3string(): ?string
    {
        return $this->strings['reset_3string'] ?? null;
    }

    public function resetFile(): ?string
    {
        return $this->strings['reset_file'] ?? null;
    }

    public function restoreCursor(): ?string
    {
        return $this->strings['restore_cursor'] ?? null;
    }

    public function rowAddress(int $row): ?string
    {
        if (!array_key_exists('row_address', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['row_address'], $row);
    }

    public function saveCursor(): ?string
    {
        return $this->strings['save_cursor'] ?? null;
    }

    public function scrollForward(): ?string
    {
        return $this->strings['scroll_forward'] ?? null;
    }

    public function scrollReverse(): ?string
    {
        return $this->strings['scroll_reverse'] ?? null;
    }

    public function setAttributes(): ?string
    {
        return $this->strings['set_attributes'] ?? null;
    }

    public function setTab(): ?string
    {
        return $this->strings['set_tab'] ?? null;
    }

    public function setWindow(): ?string
    {
        return $this->strings['set_window'] ?? null;
    }

    public function tab(): ?string
    {
        return $this->strings['tab'] ?? null;
    }

    public function toStatusLine(): ?string
    {
        return $this->strings['to_status_line'] ?? null;
    }

    public function underlineChar(): ?string
    {
        return $this->strings['underline_char'] ?? null;
    }

    public function upHalfLine(): ?string
    {
        return $this->strings['up_half_line'] ?? null;
    }

    public function initProg(): ?string
    {
        return $this->strings['init_prog'] ?? null;
    }

    public function keyA1(): ?string
    {
        return $this->strings['key_a1'] ?? null;
    }

    public function keyA3(): ?string
    {
        return $this->strings['key_a3'] ?? null;
    }

    public function keyB2(): ?string
    {
        return $this->strings['key_b2'] ?? null;
    }

    public function keyC1(): ?string
    {
        return $this->strings['key_c1'] ?? null;
    }

    public function keyC3(): ?string
    {
        return $this->strings['key_c3'] ?? null;
    }

    public function prtrNon(): ?string
    {
        return $this->strings['prtr_non'] ?? null;
    }

    public function charPadding(): ?string
    {
        return $this->strings['char_padding'] ?? null;
    }

    public function acsChars(): ?string
    {
        return $this->strings['acs_chars'] ?? null;
    }

    public function plabNorm(): ?string
    {
        return $this->strings['plab_norm'] ?? null;
    }

    public function keyBtab(): ?string
    {
        return $this->strings['key_btab'] ?? null;
    }

    public function enterXonMode(): ?string
    {
        return $this->strings['enter_xon_mode'] ?? null;
    }

    public function exitXonMode(): ?string
    {
        return $this->strings['exit_xon_mode'] ?? null;
    }

    public function enterAmMode(): ?string
    {
        return $this->strings['enter_am_mode'] ?? null;
    }

    public function exitAmMode(): ?string
    {
        return $this->strings['exit_am_mode'] ?? null;
    }

    public function xonCharacter(): ?string
    {
        return $this->strings['xon_character'] ?? null;
    }

    public function xoffCharacter(): ?string
    {
        return $this->strings['xoff_character'] ?? null;
    }

    public function enaAcs(): ?string
    {
        return $this->strings['ena_acs'] ?? null;
    }

    public function labelOn(): ?string
    {
        return $this->strings['label_on'] ?? null;
    }

    public function labelOff(): ?string
    {
        return $this->strings['label_off'] ?? null;
    }

    public function keyBeg(): ?string
    {
        return $this->strings['key_beg'] ?? null;
    }

    public function keyCancel(): ?string
    {
        return $this->strings['key_cancel'] ?? null;
    }

    public function keyClose(): ?string
    {
        return $this->strings['key_close'] ?? null;
    }

    public function keyCommand(): ?string
    {
        return $this->strings['key_command'] ?? null;
    }

    public function keyCopy(): ?string
    {
        return $this->strings['key_copy'] ?? null;
    }

    public function keyCreate(): ?string
    {
        return $this->strings['key_create'] ?? null;
    }

    public function keyEnd(): ?string
    {
        return $this->strings['key_end'] ?? null;
    }

    public function keyEnter(): ?string
    {
        return $this->strings['key_enter'] ?? null;
    }

    public function keyExit(): ?string
    {
        return $this->strings['key_exit'] ?? null;
    }

    public function keyFind(): ?string
    {
        return $this->strings['key_find'] ?? null;
    }

    public function keyHelp(): ?string
    {
        return $this->strings['key_help'] ?? null;
    }

    public function keyMark(): ?string
    {
        return $this->strings['key_mark'] ?? null;
    }

    public function keyMessage(): ?string
    {
        return $this->strings['key_message'] ?? null;
    }

    public function keyMove(): ?string
    {
        return $this->strings['key_move'] ?? null;
    }

    public function keyNext(): ?string
    {
        return $this->strings['key_next'] ?? null;
    }

    public function keyOpen(): ?string
    {
        return $this->strings['key_open'] ?? null;
    }

    public function keyOptions(): ?string
    {
        return $this->strings['key_options'] ?? null;
    }

    public function keyPrevious(): ?string
    {
        return $this->strings['key_previous'] ?? null;
    }

    public function keyPrint(): ?string
    {
        return $this->strings['key_print'] ?? null;
    }

    public function keyRedo(): ?string
    {
        return $this->strings['key_redo'] ?? null;
    }

    public function keyReference(): ?string
    {
        return $this->strings['key_reference'] ?? null;
    }

    public function keyRefresh(): ?string
    {
        return $this->strings['key_refresh'] ?? null;
    }

    public function keyReplace(): ?string
    {
        return $this->strings['key_replace'] ?? null;
    }

    public function keyRestart(): ?string
    {
        return $this->strings['key_restart'] ?? null;
    }

    public function keyResume(): ?string
    {
        return $this->strings['key_resume'] ?? null;
    }

    public function keySave(): ?string
    {
        return $this->strings['key_save'] ?? null;
    }

    public function keySuspend(): ?string
    {
        return $this->strings['key_suspend'] ?? null;
    }

    public function keyUndo(): ?string
    {
        return $this->strings['key_undo'] ?? null;
    }

    public function keySbeg(): ?string
    {
        return $this->strings['key_sbeg'] ?? null;
    }

    public function keyScancel(): ?string
    {
        return $this->strings['key_scancel'] ?? null;
    }

    public function keyScommand(): ?string
    {
        return $this->strings['key_scommand'] ?? null;
    }

    public function keyScopy(): ?string
    {
        return $this->strings['key_scopy'] ?? null;
    }

    public function keyScreate(): ?string
    {
        return $this->strings['key_screate'] ?? null;
    }

    public function keySdc(): ?string
    {
        return $this->strings['key_sdc'] ?? null;
    }

    public function keySdl(): ?string
    {
        return $this->strings['key_sdl'] ?? null;
    }

    public function keySelect(): ?string
    {
        return $this->strings['key_select'] ?? null;
    }

    public function keySend(): ?string
    {
        return $this->strings['key_send'] ?? null;
    }

    public function keySeol(): ?string
    {
        return $this->strings['key_seol'] ?? null;
    }

    public function keySexit(): ?string
    {
        return $this->strings['key_sexit'] ?? null;
    }

    public function keySfind(): ?string
    {
        return $this->strings['key_sfind'] ?? null;
    }

    public function keyShelp(): ?string
    {
        return $this->strings['key_shelp'] ?? null;
    }

    public function keyShome(): ?string
    {
        return $this->strings['key_shome'] ?? null;
    }

    public function keySic(): ?string
    {
        return $this->strings['key_sic'] ?? null;
    }

    public function keySleft(): ?string
    {
        return $this->strings['key_sleft'] ?? null;
    }

    public function keySmessage(): ?string
    {
        return $this->strings['key_smessage'] ?? null;
    }

    public function keySmove(): ?string
    {
        return $this->strings['key_smove'] ?? null;
    }

    public function keySnext(): ?string
    {
        return $this->strings['key_snext'] ?? null;
    }

    public function keySoptions(): ?string
    {
        return $this->strings['key_soptions'] ?? null;
    }

    public function keySprevious(): ?string
    {
        return $this->strings['key_sprevious'] ?? null;
    }

    public function keySprint(): ?string
    {
        return $this->strings['key_sprint'] ?? null;
    }

    public function keySredo(): ?string
    {
        return $this->strings['key_sredo'] ?? null;
    }

    public function keySreplace(): ?string
    {
        return $this->strings['key_sreplace'] ?? null;
    }

    public function keySright(): ?string
    {
        return $this->strings['key_sright'] ?? null;
    }

    public function keySrsume(): ?string
    {
        return $this->strings['key_srsume'] ?? null;
    }

    public function keySsave(): ?string
    {
        return $this->strings['key_ssave'] ?? null;
    }

    public function keySsuspend(): ?string
    {
        return $this->strings['key_ssuspend'] ?? null;
    }

    public function keySundo(): ?string
    {
        return $this->strings['key_sundo'] ?? null;
    }

    public function reqForInput(): ?string
    {
        return $this->strings['req_for_input'] ?? null;
    }

    public function keyF11(): ?string
    {
        return $this->strings['key_f11'] ?? null;
    }

    public function keyF12(): ?string
    {
        return $this->strings['key_f12'] ?? null;
    }

    public function keyF13(): ?string
    {
        return $this->strings['key_f13'] ?? null;
    }

    public function keyF14(): ?string
    {
        return $this->strings['key_f14'] ?? null;
    }

    public function keyF15(): ?string
    {
        return $this->strings['key_f15'] ?? null;
    }

    public function keyF16(): ?string
    {
        return $this->strings['key_f16'] ?? null;
    }

    public function keyF17(): ?string
    {
        return $this->strings['key_f17'] ?? null;
    }

    public function keyF18(): ?string
    {
        return $this->strings['key_f18'] ?? null;
    }

    public function keyF19(): ?string
    {
        return $this->strings['key_f19'] ?? null;
    }

    public function keyF20(): ?string
    {
        return $this->strings['key_f20'] ?? null;
    }

    public function keyF21(): ?string
    {
        return $this->strings['key_f21'] ?? null;
    }

    public function keyF22(): ?string
    {
        return $this->strings['key_f22'] ?? null;
    }

    public function keyF23(): ?string
    {
        return $this->strings['key_f23'] ?? null;
    }

    public function keyF24(): ?string
    {
        return $this->strings['key_f24'] ?? null;
    }

    public function keyF25(): ?string
    {
        return $this->strings['key_f25'] ?? null;
    }

    public function keyF26(): ?string
    {
        return $this->strings['key_f26'] ?? null;
    }

    public function keyF27(): ?string
    {
        return $this->strings['key_f27'] ?? null;
    }

    public function keyF28(): ?string
    {
        return $this->strings['key_f28'] ?? null;
    }

    public function keyF29(): ?string
    {
        return $this->strings['key_f29'] ?? null;
    }

    public function keyF30(): ?string
    {
        return $this->strings['key_f30'] ?? null;
    }

    public function keyF31(): ?string
    {
        return $this->strings['key_f31'] ?? null;
    }

    public function keyF32(): ?string
    {
        return $this->strings['key_f32'] ?? null;
    }

    public function keyF33(): ?string
    {
        return $this->strings['key_f33'] ?? null;
    }

    public function keyF34(): ?string
    {
        return $this->strings['key_f34'] ?? null;
    }

    public function keyF35(): ?string
    {
        return $this->strings['key_f35'] ?? null;
    }

    public function keyF36(): ?string
    {
        return $this->strings['key_f36'] ?? null;
    }

    public function keyF37(): ?string
    {
        return $this->strings['key_f37'] ?? null;
    }

    public function keyF38(): ?string
    {
        return $this->strings['key_f38'] ?? null;
    }

    public function keyF39(): ?string
    {
        return $this->strings['key_f39'] ?? null;
    }

    public function keyF40(): ?string
    {
        return $this->strings['key_f40'] ?? null;
    }

    public function keyF41(): ?string
    {
        return $this->strings['key_f41'] ?? null;
    }

    public function keyF42(): ?string
    {
        return $this->strings['key_f42'] ?? null;
    }

    public function keyF43(): ?string
    {
        return $this->strings['key_f43'] ?? null;
    }

    public function keyF44(): ?string
    {
        return $this->strings['key_f44'] ?? null;
    }

    public function keyF45(): ?string
    {
        return $this->strings['key_f45'] ?? null;
    }

    public function keyF46(): ?string
    {
        return $this->strings['key_f46'] ?? null;
    }

    public function keyF47(): ?string
    {
        return $this->strings['key_f47'] ?? null;
    }

    public function keyF48(): ?string
    {
        return $this->strings['key_f48'] ?? null;
    }

    public function keyF49(): ?string
    {
        return $this->strings['key_f49'] ?? null;
    }

    public function keyF50(): ?string
    {
        return $this->strings['key_f50'] ?? null;
    }

    public function keyF51(): ?string
    {
        return $this->strings['key_f51'] ?? null;
    }

    public function keyF52(): ?string
    {
        return $this->strings['key_f52'] ?? null;
    }

    public function keyF53(): ?string
    {
        return $this->strings['key_f53'] ?? null;
    }

    public function keyF54(): ?string
    {
        return $this->strings['key_f54'] ?? null;
    }

    public function keyF55(): ?string
    {
        return $this->strings['key_f55'] ?? null;
    }

    public function keyF56(): ?string
    {
        return $this->strings['key_f56'] ?? null;
    }

    public function keyF57(): ?string
    {
        return $this->strings['key_f57'] ?? null;
    }

    public function keyF58(): ?string
    {
        return $this->strings['key_f58'] ?? null;
    }

    public function keyF59(): ?string
    {
        return $this->strings['key_f59'] ?? null;
    }

    public function keyF60(): ?string
    {
        return $this->strings['key_f60'] ?? null;
    }

    public function keyF61(): ?string
    {
        return $this->strings['key_f61'] ?? null;
    }

    public function keyF62(): ?string
    {
        return $this->strings['key_f62'] ?? null;
    }

    public function keyF63(): ?string
    {
        return $this->strings['key_f63'] ?? null;
    }

    public function clrBol(): ?string
    {
        return $this->strings['clr_bol'] ?? null;
    }

    public function clearMargins(): ?string
    {
        return $this->strings['clear_margins'] ?? null;
    }

    public function setLeftMargin(): ?string
    {
        return $this->strings['set_left_margin'] ?? null;
    }

    public function setRightMargin(): ?string
    {
        return $this->strings['set_right_margin'] ?? null;
    }

    public function labelFormat(): ?string
    {
        return $this->strings['label_format'] ?? null;
    }

    public function setClock(): ?string
    {
        return $this->strings['set_clock'] ?? null;
    }

    public function displayClock(): ?string
    {
        return $this->strings['display_clock'] ?? null;
    }

    public function removeClock(): ?string
    {
        return $this->strings['remove_clock'] ?? null;
    }

    public function createWindow(): ?string
    {
        return $this->strings['create_window'] ?? null;
    }

    public function gotoWindow(): ?string
    {
        return $this->strings['goto_window'] ?? null;
    }

    public function hangup(): ?string
    {
        return $this->strings['hangup'] ?? null;
    }

    public function dialPhone(): ?string
    {
        return $this->strings['dial_phone'] ?? null;
    }

    public function quickDial(): ?string
    {
        return $this->strings['quick_dial'] ?? null;
    }

    public function tone(): ?string
    {
        return $this->strings['tone'] ?? null;
    }

    public function pulse(): ?string
    {
        return $this->strings['pulse'] ?? null;
    }

    public function flashHook(): ?string
    {
        return $this->strings['flash_hook'] ?? null;
    }

    public function fixedPause(): ?string
    {
        return $this->strings['fixed_pause'] ?? null;
    }

    public function waitTone(): ?string
    {
        return $this->strings['wait_tone'] ?? null;
    }

    public function user0(): ?string
    {
        return $this->strings['user0'] ?? null;
    }

    public function user1(): ?string
    {
        return $this->strings['user1'] ?? null;
    }

    public function user2(): ?string
    {
        return $this->strings['user2'] ?? null;
    }

    public function user3(): ?string
    {
        return $this->strings['user3'] ?? null;
    }

    public function user4(): ?string
    {
        return $this->strings['user4'] ?? null;
    }

    public function user5(): ?string
    {
        return $this->strings['user5'] ?? null;
    }

    public function user6(): ?string
    {
        return $this->strings['user6'] ?? null;
    }

    public function user7(): ?string
    {
        return $this->strings['user7'] ?? null;
    }

    public function user8(): ?string
    {
        return $this->strings['user8'] ?? null;
    }

    public function user9(): ?string
    {
        return $this->strings['user9'] ?? null;
    }

    public function origPair(): ?string
    {
        return $this->strings['orig_pair'] ?? null;
    }

    public function origColors(): ?string
    {
        return $this->strings['orig_colors'] ?? null;
    }

    public function initializeColor(int $color, int $red, int $green, int $blue): ?string
    {
        if (!array_key_exists('initialize_color', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['initialize_color'], $color, $red, $green, $blue);
    }

    public function initializePair(): ?string
    {
        return $this->strings['initialize_pair'] ?? null;
    }

    public function setColorPair(): ?string
    {
        return $this->strings['set_color_pair'] ?? null;
    }

    public function changeCharPitch(): ?string
    {
        return $this->strings['change_char_pitch'] ?? null;
    }

    public function changeLinePitch(): ?string
    {
        return $this->strings['change_line_pitch'] ?? null;
    }

    public function changeResHorz(): ?string
    {
        return $this->strings['change_res_horz'] ?? null;
    }

    public function changeResVert(): ?string
    {
        return $this->strings['change_res_vert'] ?? null;
    }

    public function defineChar(): ?string
    {
        return $this->strings['define_char'] ?? null;
    }

    public function enterDoublewideMode(): ?string
    {
        return $this->strings['enter_doublewide_mode'] ?? null;
    }

    public function enterDraftQuality(): ?string
    {
        return $this->strings['enter_draft_quality'] ?? null;
    }

    public function enterItalicsMode(): ?string
    {
        return $this->strings['enter_italics_mode'] ?? null;
    }

    public function enterLeftwardMode(): ?string
    {
        return $this->strings['enter_leftward_mode'] ?? null;
    }

    public function enterMicroMode(): ?string
    {
        return $this->strings['enter_micro_mode'] ?? null;
    }

    public function enterNearLetterQuality(): ?string
    {
        return $this->strings['enter_near_letter_quality'] ?? null;
    }

    public function enterNormalQuality(): ?string
    {
        return $this->strings['enter_normal_quality'] ?? null;
    }

    public function enterShadowMode(): ?string
    {
        return $this->strings['enter_shadow_mode'] ?? null;
    }

    public function enterSubscriptMode(): ?string
    {
        return $this->strings['enter_subscript_mode'] ?? null;
    }

    public function enterSuperscriptMode(): ?string
    {
        return $this->strings['enter_superscript_mode'] ?? null;
    }

    public function enterUpwardMode(): ?string
    {
        return $this->strings['enter_upward_mode'] ?? null;
    }

    public function exitDoublewideMode(): ?string
    {
        return $this->strings['exit_doublewide_mode'] ?? null;
    }

    public function exitItalicsMode(): ?string
    {
        return $this->strings['exit_italics_mode'] ?? null;
    }

    public function exitLeftwardMode(): ?string
    {
        return $this->strings['exit_leftward_mode'] ?? null;
    }

    public function exitMicroMode(): ?string
    {
        return $this->strings['exit_micro_mode'] ?? null;
    }

    public function exitShadowMode(): ?string
    {
        return $this->strings['exit_shadow_mode'] ?? null;
    }

    public function exitSubscriptMode(): ?string
    {
        return $this->strings['exit_subscript_mode'] ?? null;
    }

    public function exitSuperscriptMode(): ?string
    {
        return $this->strings['exit_superscript_mode'] ?? null;
    }

    public function exitUpwardMode(): ?string
    {
        return $this->strings['exit_upward_mode'] ?? null;
    }

    public function microColumnAddress(): ?string
    {
        return $this->strings['micro_column_address'] ?? null;
    }

    public function microDown(): ?string
    {
        return $this->strings['micro_down'] ?? null;
    }

    public function microLeft(): ?string
    {
        return $this->strings['micro_left'] ?? null;
    }

    public function microRight(): ?string
    {
        return $this->strings['micro_right'] ?? null;
    }

    public function microRowAddress(): ?string
    {
        return $this->strings['micro_row_address'] ?? null;
    }

    public function microUp(): ?string
    {
        return $this->strings['micro_up'] ?? null;
    }

    public function orderOfPins(): ?string
    {
        return $this->strings['order_of_pins'] ?? null;
    }

    public function parmDownMicro(): ?string
    {
        return $this->strings['parm_down_micro'] ?? null;
    }

    public function parmLeftMicro(): ?string
    {
        return $this->strings['parm_left_micro'] ?? null;
    }

    public function parmRightMicro(): ?string
    {
        return $this->strings['parm_right_micro'] ?? null;
    }

    public function parmUpMicro(): ?string
    {
        return $this->strings['parm_up_micro'] ?? null;
    }

    public function selectCharSet(): ?string
    {
        return $this->strings['select_char_set'] ?? null;
    }

    public function setBottomMargin(): ?string
    {
        return $this->strings['set_bottom_margin'] ?? null;
    }

    public function setBottomMarginParm(): ?string
    {
        return $this->strings['set_bottom_margin_parm'] ?? null;
    }

    public function setLeftMarginParm(int $p1): ?string
    {
        if (!array_key_exists('set_left_margin_parm', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['set_left_margin_parm'], $p1);
    }

    public function setRightMarginParm(int $p1): ?string
    {
        if (!array_key_exists('set_right_margin_parm', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['set_right_margin_parm'], $p1);
    }

    public function setTopMargin(): ?string
    {
        return $this->strings['set_top_margin'] ?? null;
    }

    public function setTopMarginParm(): ?string
    {
        return $this->strings['set_top_margin_parm'] ?? null;
    }

    public function startBitImage(): ?string
    {
        return $this->strings['start_bit_image'] ?? null;
    }

    public function startCharSetDef(): ?string
    {
        return $this->strings['start_char_set_def'] ?? null;
    }

    public function stopBitImage(): ?string
    {
        return $this->strings['stop_bit_image'] ?? null;
    }

    public function stopCharSetDef(): ?string
    {
        return $this->strings['stop_char_set_def'] ?? null;
    }

    public function subscriptCharacters(): ?string
    {
        return $this->strings['subscript_characters'] ?? null;
    }

    public function superscriptCharacters(): ?string
    {
        return $this->strings['superscript_characters'] ?? null;
    }

    public function theseCauseCr(): ?string
    {
        return $this->strings['these_cause_cr'] ?? null;
    }

    public function zeroMotion(): ?string
    {
        return $this->strings['zero_motion'] ?? null;
    }

    public function charSetNames(): ?string
    {
        return $this->strings['char_set_names'] ?? null;
    }

    public function keyMouse(): ?string
    {
        return $this->strings['key_mouse'] ?? null;
    }

    public function mouseInfo(): ?string
    {
        return $this->strings['mouse_info'] ?? null;
    }

    public function reqMousePos(): ?string
    {
        return $this->strings['req_mouse_pos'] ?? null;
    }

    public function getMouse(): ?string
    {
        return $this->strings['get_mouse'] ?? null;
    }

    public function setAForeground(int $color): ?string
    {
        if (!array_key_exists('set_a_foreground', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['set_a_foreground'], $color);
    }

    public function setABackground(int $color): ?string
    {
        if (!array_key_exists('set_a_background', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['set_a_background'], $color);
    }

    public function pkeyPlab(): ?string
    {
        return $this->strings['pkey_plab'] ?? null;
    }

    public function deviceType(): ?string
    {
        return $this->strings['device_type'] ?? null;
    }

    public function codeSetInit(): ?string
    {
        return $this->strings['code_set_init'] ?? null;
    }

    public function set0DesSeq(): ?string
    {
        return $this->strings['set0_des_seq'] ?? null;
    }

    public function set1DesSeq(): ?string
    {
        return $this->strings['set1_des_seq'] ?? null;
    }

    public function set2DesSeq(): ?string
    {
        return $this->strings['set2_des_seq'] ?? null;
    }

    public function set3DesSeq(): ?string
    {
        return $this->strings['set3_des_seq'] ?? null;
    }

    public function setLrMargin(int $p1, int $p2): ?string
    {
        if (!array_key_exists('set_lr_margin', $this->strings)) {
            return null;
        }

        return ($this->compiler)($this->strings['set_lr_margin'], $p1, $p2);
    }

    public function setTbMargin(): ?string
    {
        return $this->strings['set_tb_margin'] ?? null;
    }

    public function bitImageRepeat(): ?string
    {
        return $this->strings['bit_image_repeat'] ?? null;
    }

    public function bitImageNewline(): ?string
    {
        return $this->strings['bit_image_newline'] ?? null;
    }

    public function bitImageCarriageReturn(): ?string
    {
        return $this->strings['bit_image_carriage_return'] ?? null;
    }

    public function colorNames(): ?string
    {
        return $this->strings['color_names'] ?? null;
    }

    public function defineBitImageRegion(): ?string
    {
        return $this->strings['define_bit_image_region'] ?? null;
    }

    public function endBitImageRegion(): ?string
    {
        return $this->strings['end_bit_image_region'] ?? null;
    }

    public function setColorBand(): ?string
    {
        return $this->strings['set_color_band'] ?? null;
    }

    public function setPageLength(): ?string
    {
        return $this->strings['set_page_length'] ?? null;
    }

    public function displayPcChar(): ?string
    {
        return $this->strings['display_pc_char'] ?? null;
    }

    public function enterPcCharsetMode(): ?string
    {
        return $this->strings['enter_pc_charset_mode'] ?? null;
    }

    public function exitPcCharsetMode(): ?string
    {
        return $this->strings['exit_pc_charset_mode'] ?? null;
    }

    public function enterScancodeMode(): ?string
    {
        return $this->strings['enter_scancode_mode'] ?? null;
    }

    public function exitScancodeMode(): ?string
    {
        return $this->strings['exit_scancode_mode'] ?? null;
    }

    public function pcTermOptions(): ?string
    {
        return $this->strings['pc_term_options'] ?? null;
    }

    public function scancodeEscape(): ?string
    {
        return $this->strings['scancode_escape'] ?? null;
    }

    public function altScancodeEsc(): ?string
    {
        return $this->strings['alt_scancode_esc'] ?? null;
    }

    public function enterHorizontalHlMode(): ?string
    {
        return $this->strings['enter_horizontal_hl_mode'] ?? null;
    }

    public function enterLeftHlMode(): ?string
    {
        return $this->strings['enter_left_hl_mode'] ?? null;
    }

    public function enterLowHlMode(): ?string
    {
        return $this->strings['enter_low_hl_mode'] ?? null;
    }

    public function enterRightHlMode(): ?string
    {
        return $this->strings['enter_right_hl_mode'] ?? null;
    }

    public function enterTopHlMode(): ?string
    {
        return $this->strings['enter_top_hl_mode'] ?? null;
    }

    public function enterVerticalHlMode(): ?string
    {
        return $this->strings['enter_vertical_hl_mode'] ?? null;
    }

    public function setAAttributes(): ?string
    {
        return $this->strings['set_a_attributes'] ?? null;
    }

    public function setPglenInch(): ?string
    {
        return $this->strings['set_pglen_inch'] ?? null;
    }
}
