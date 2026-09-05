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
 * Languages configuration for the Category Course Cards plugin.
 *
 * @package   block_categorycoursecards
 * @copyright 2026 Saša Dumić, Cognita <sasa.dumic@cognita.hr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Category course cards';
$string['categorycoursecards:addinstance'] = 'Add a new category course cards block';
$string['categorycoursecards:myaddinstance'] = 'Add a new category course cards block to the Dashboard';

$string['newblock'] = 'New category course cards';
$string['configtitle'] = 'Block title';
$string['customtitle'] = 'Courses from {$a}';
$string['recursive'] = 'Include sub-categories';
$string['coursesperpage'] = 'Courses per page';
$string['coursesperpage_help'] = 'Maximum number of course cards displayed on each page of the block. Enter a value from 1 to 36.';
$string['coursesperpageinvalid'] = 'Courses per page must be a whole number from 1 to 36.';

$string['privacy:metadata'] = 'The Category course cards block does not store personal user data. It only displays existing course information from Moodle.';
$string['displaymode'] = 'Course display';
$string['displaymode_help'] = 'Choose whether courses are displayed using the responsive card layout provided by this plugin or Moodle\'s standard course listing controlled by the active theme.';
$string['displaymodecards'] = 'Card layout';
$string['displaymodetheme'] = 'Theme default';
