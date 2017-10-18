<?php

$admin_sidebar = [];

function add_menu_section($id, $title, $position = false, $exists = false) {

    global $admin_sidebar;

    if ($position == false) {
        $position = (INTEGER) count($admin_sidebar);
    }

    if ($exists) {
        $position++;
    }

    if (isset($admin_sidebar[$position])) {
        return add_menu_section($id, $title, $position, true);
    }

    $admin_sidebar[$position][$id] = [
        'title' => $title
    ];

}

function add_menu_item($section, $id, $title, $icon = false, $link = false, $position = false, $exists = false) {

    global $admin_sidebar;

    $index = find_section_index($section, $admin_sidebar);

    if (is_int($index)) {
        $condition_section = true;
    } else {
        $condition_section = false;
    }

    if ($condition_section) {

        if (!isset($admin_sidebar[$index][$section]['menu'])) {
            $admin_sidebar[$index][$section]['menu'] = [];
        }

        if ($position == false) {
            $position = (INTEGER) count($admin_sidebar[$index][$section]['menu']);
        }

        if ($exists) {
            $position++;
        }

        if (isset($admin_sidebar[$index][$section]['menu'][$position])) {
            return add_menu_item($section, $id, $title, $icon, $link, $position, true);
        }

        if ($icon == false) {
            $icon = 'fa fa-cogs';
        }

        if ($link == false) {
            $link = 'javascript:;';
        }

        $admin_sidebar[$index][$section]['menu'][$position][$id] = [
            'icon' => $icon,
            'title' => $title,
            'link' => $link
        ];

        return true;

    } else {
        return false;
    }

}

function add_submenu_item($section, $menu, $title, $link = false, $position = false, $exists = false) {

    global $admin_sidebar;

    $section_index = find_section_index($section, $admin_sidebar);
    $menu_index = find_menu_index($section, $menu, $admin_sidebar);

    if (is_int($menu_index)) {
        $condition_menu = true;
    } else {
        $condition_menu = false;
    }

    if (is_int($section_index)) {
        $condition_section = true;
    } else {
        $condition_section = false;
    }

    if ($condition_section && $condition_menu) {

        if (!isset($admin_sidebar[$section_index][$section]['menu'][$menu_index][$menu]['submenu'])) {

            $admin_sidebar[$section_index][$section]['menu'][$menu_index][$menu]['submenu'] = [];

            print_r($admin_sidebar[$section_index][$section]['menu'][$menu_index][$menu]['submenu']);

        }

        if ($position == false) {
            $position = (INTEGER) count($admin_sidebar[$section_index][$section]['menu'][$menu_index][$menu]['submenu']);
        }

        if ($exists) {
            $position++;
        }

        if (isset($admin_sidebar[$section_index][$section]['menu'][$menu_index][$menu]['submenu'][$position])) {

            return add_submenu_item($section, $menu, $title, $link, $position, true);

        }

        $admin_sidebar[$section_index][$section]['menu'][$menu_index][$menu]['submenu'][$position] = [
            'title' => $title,
            'link' => $link
        ];

    } else {
        return false;
    }

}

function find_section_index($section_id, $items) {

    foreach ($items as $key => $value) {

        if (isset($value[$section_id])) {

            return $key;

        }

    }

    return false;

}

function find_menu_index($section_id, $menu_id, $items){

    $section_index = find_section_index($section_id, $items);

    if (is_int($section_index)) {
        $condition_section = true;
    } else {
        $condition_section = false;
    }

    if ($condition_section) {

        if (isset($items[$section_index][$section_id]['menu'])) {

            $all_menu = $items[$section_index][$section_id]['menu'];

            foreach ($all_menu as $key => $value) {

                if (isset($value[$menu_id])) {

                    return $key;

                }

            }

        }

    }

    return false;

}