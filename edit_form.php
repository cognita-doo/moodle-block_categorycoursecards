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
 * Block edit form class for the Category Course Cards plugin.
 *
 * @package   block_categorycoursecards
 * @copyright 2026 Saša Dumić, Cognita <sasa.dumic@cognita.hr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_categorycoursecards_edit_form extends block_edit_form {

    /** Default number of courses displayed per page. */
    private const DEFAULT_COURSES_PER_PAGE = 12;

    /** Minimum number of courses allowed per page. */
    private const MIN_COURSES_PER_PAGE = 1;

    /** Maximum number of courses allowed per page. */
    private const MAX_COURSES_PER_PAGE = 36;

    /**
     * Defines the block configuration form.
     *
     * @param MoodleQuickForm $mform The form being built.
     * @return void
     */
    protected function specific_definition($mform) {
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('configtitle', 'block_categorycoursecards'));
        $mform->setType('config_title', PARAM_TEXT);

        $displaylist = core_course_category::make_categories_list();
        $options = [
            'multiple' => true,
        ];
        $mform->addElement(
            'autocomplete',
            'config_category',
            get_string('coursecategory'),
            $displaylist,
            $options
        );
        $mform->addRule('config_category', null, 'required', null, 'client');
        $mform->addHelpButton('config_category', 'coursecategory');

        $mform->addElement(
            'advcheckbox',
            'config_recursive',
            get_string('recursive', 'block_categorycoursecards'),
            '',
            ['group' => 1],
            [0, 1]
        );
        $mform->setDefault('config_recursive', 1);

        $mform->addElement(
            'select',
            'config_displaymode',
            get_string('displaymode', 'block_categorycoursecards'),
            [
                'cards' => get_string('displaymodecards', 'block_categorycoursecards'),
                'theme' => get_string('displaymodetheme', 'block_categorycoursecards'),
            ]
        );
        $mform->setDefault('config_displaymode', 'cards');
        $mform->addHelpButton('config_displaymode', 'displaymode', 'block_categorycoursecards');

        $mform->addElement(
            'text',
            'config_coursesperpage',
            get_string('coursesperpage', 'block_categorycoursecards'),
            ['size' => 4, 'min' => self::MIN_COURSES_PER_PAGE, 'max' => self::MAX_COURSES_PER_PAGE]
        );
        $mform->setType('config_coursesperpage', PARAM_INT);
        $mform->setDefault('config_coursesperpage', self::DEFAULT_COURSES_PER_PAGE);
        $mform->addRule('config_coursesperpage', null, 'required', null, 'client');
        $mform->addRule('config_coursesperpage', get_string('err_numeric', 'form'), 'numeric', null, 'client');
        $mform->addHelpButton('config_coursesperpage', 'coursesperpage', 'block_categorycoursecards');
    }

    /**
     * Validates the block configuration form.
     *
     * @param array $data Submitted form data.
     * @param array $files Submitted files.
     * @return array Validation errors.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        $perpage = $data['config_coursesperpage'] ?? null;

        if (
            filter_var($perpage, FILTER_VALIDATE_INT) === false
            || (int) $perpage < self::MIN_COURSES_PER_PAGE
            || (int) $perpage > self::MAX_COURSES_PER_PAGE
        ) {
            $errors['config_coursesperpage'] = get_string('coursesperpageinvalid', 'block_categorycoursecards');
        }

        return $errors;
    }

    /**
     * Displays the configuration form when adding a new block instance.
     *
     * @return bool
     */
    public static function display_form_when_adding(): bool {
        return true;
    }
}
