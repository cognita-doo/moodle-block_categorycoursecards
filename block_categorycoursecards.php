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
 * Block definition class for the Category Course Cards plugin.
 *
 * @package   block_categorycoursecards
 * @copyright 2026 Saša Dumić, Cognita <sasa.dumic@cognita.hr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_categorycoursecards extends block_base {

    /** Default number of courses displayed per page. */
    private const DEFAULT_COURSES_PER_PAGE = 12;

    /** Minimum number of courses allowed per page. */
    private const MIN_COURSES_PER_PAGE = 1;

    /** Maximum number of courses allowed per page. */
    private const MAX_COURSES_PER_PAGE = 36;

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_categorycoursecards');
    }

    /**
     * Gets the block contents.
     *
     * @return stdClass The block content.
     */
    public function get_content() {
        global $OUTPUT, $PAGE, $CFG;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';

        require_once($CFG->dirroot . '/course/renderer.php');
        $chelper = new coursecat_helper();
        $recursive = !empty($this->config->recursive);
        $chelper->set_courses_display_options([
            'recursive' => $recursive,
        ]);
        $chelper->set_attributes(['class' => 'frontpage-course-list-all']);

        $allcourses = [];
        $categories = (array) ($this->config->category ?? []);
        foreach ($categories as $cat) {
            try {
                $coursecat = \core_course_category::get($cat);
                $courses = $coursecat->get_courses($chelper->get_courses_display_options());
            } catch (\moodle_exception $e) {
                $courses = [];
            }

            foreach ($courses as $course) {
                $allcourses[$course->id] = $course;
            }
        }

        $perpage = (int) ($this->config->coursesperpage ?? self::DEFAULT_COURSES_PER_PAGE);
        if ($perpage < self::MIN_COURSES_PER_PAGE || $perpage > self::MAX_COURSES_PER_PAGE) {
            $perpage = self::DEFAULT_COURSES_PER_PAGE;
        }

        $totalcount = count($allcourses);
        $pageparam = 'ccpage_' . $this->instance->id;
        $page = max(0, optional_param($pageparam, 0, PARAM_INT));
        $maxpage = max(0, (int) ceil($totalcount / $perpage) - 1);
        $page = min($page, $maxpage);

        $courses = array_slice($allcourses, $page * $perpage, $perpage, true);

        $cr = $PAGE->get_renderer('core', 'course');
        $courselist = $cr->courses_list($courses, true, 'frontpage-course-list-all');

        if ($totalcount > $perpage) {
            $paginationurl = new moodle_url($PAGE->url);
            $paginationurl->remove_params($pageparam);

            $pagingbar = new paging_bar($totalcount, $page, $perpage, $paginationurl);
            $pagingbar->pagevar = $pageparam;
            $paginghtml = $OUTPUT->render($pagingbar);

            $this->content->text = $paginghtml . $courselist . $paginghtml;
        } else {
            $this->content->text = $courselist;
        }

        return $this->content;
    }

    /**
     * Defines in which pages this block can be added.
     *
     * @return array of the pages where the block can be added.
     */
    public function applicable_formats() {
        return [
            'admin' => false,
            'site-index' => true,
            'course-view' => false,
            'mod' => false,
            'my' => true,
        ];
    }

    /**
     * Specialises the block title based on its configuration.
     *
     * @return void
     */
    public function specialization() {
        if (!empty($this->config->title)) {
            $this->title = format_string($this->config->title, true, ['context' => $this->context]);
        } else {
            $categorynames = [];
            $categories = (array) ($this->config->category ?? []);

            foreach ($categories as $cat) {
                try {
                    $category = core_course_category::get($cat);
                    $categorynames[] = $category->get_formatted_name();
                } catch (\moodle_exception $e) {
                    continue;
                }
            }

            if (!empty($categorynames)) {
                $title = implode(' & ', $categorynames);

                $this->title = format_string(
                    get_string('customtitle', 'block_categorycoursecards', $title),
                    true,
                    ['context' => $this->context]
                );
            }
        }
    }

    /**
     * Allows multiple instances of this block.
     *
     * @return bool
     */
    public function instance_allow_multiple() {
        return true;
    }
}
