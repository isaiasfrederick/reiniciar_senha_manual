<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    block_cead_acessibilidade
 * @copyright  2023 CEAD UFTM - Isaias Frederick Januario (isaias.januario@uftm.edu.br)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// This is the version of the plugin. // YYYYMMDDVV.
// $plugin->version = 2023051501;

// This is the version of Moodle this plugin requires - Moodle v3.8
// $plugin->requires = 2019111800;

// This is the component name of the plugin - it always starts with 'theme_'
// for themes and should be the same as the name of the folder.
$plugin->component = 'local_uftm_reiniciarsenhamanual';

// This is a list of plugins, this plugin depends on (and their versions).
$plugin->dependencies = [
    'theme_boost' => 2019111800
];

// This is a stable release.
$plugin->maturity = MATURITY_STABLE;

// This is the named version.
$plugin->release = '1.6.3';


$plugin->version = 2019111801;  // YYYYMMDDHH (year, month, day, 24-hr time) - THE SAME AS THE THEME VERSION, RELEASED AT THE SAME TIME
$plugin->requires = 2019111800; // YYYYMMDDHH (This is the release version for Moodle 2.0)
