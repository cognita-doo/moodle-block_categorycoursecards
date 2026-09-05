# Category Course Cards

Category Course Cards is a Moodle block that displays courses from one or more selected course categories. It provides its own responsive card layout and can alternatively use Moodle's standard course listing controlled by the active theme.

The block can be added to the Site home or Dashboard. Each block instance can use its own category selection, title, sub-category behaviour, and number of course cards displayed per page.

## Features

- Select one or more course categories.
- Optionally include courses from sub-categories.
- Display courses using the plugin's responsive card layout (default) or Moodle's theme-controlled course listing.
- Set a custom block title or let the block generate one from the selected categories.
- Configure the number of course cards per page from 1 to 36; the default is 12.
- Use multiple independent instances of the block on the same page.
- Paginate course cards independently for each block instance.

## Requirements

- Moodle 4.5 to 5.2.

The initial release has been tested on Moodle 4.5.13+, 5.1.6, and 5.2.2.

## Installation

Install the plugin using Moodle's standard plugin installation process, or copy the `categorycoursecards` directory to:

`blocks/categorycoursecards`

Then visit **Site administration > Notifications** to complete the installation.

## Configuration

After adding the block, open its configuration and set:

- **Block title** — optional custom title.
- **Course categories** — one or more categories whose courses should be displayed.
- **Include sub-categories** — include courses from descendants of the selected categories.
- **Course display** — choose **Card layout** (default) or **Theme default**.
- **Courses per page** — number of courses shown on one page of the block, from 1 to 36.

If no custom title is entered, the block generates a title from the selected category names.

## Display modes

By default, the plugin uses its own responsive card layout. Cards include the course image, course name, and course summary when available. The layout displays up to three columns on wider screens and adapts to two or one column on smaller screens.

The **Theme default** option uses Moodle's standard course renderer instead. In that mode, the visual presentation depends on the active Moodle theme and the page or block region where the block is displayed. For example, a theme may render course listings as cards on the Site home while using a standard course listing on the Dashboard.

## Privacy

This plugin does not store personal user data. It only displays course information already available in Moodle.

## Project links

- Source code: https://github.com/cognita-doo/moodle-block_categorycoursecards
- Issue tracker: https://github.com/cognita-doo/moodle-block_categorycoursecards/issues

## License

This plugin is licensed under the GNU GPL v3 or later.
