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
 *
 * @package    local_obu_indicators
 * @copyright  2019, Oxford Brookes University {@link http://www.brookes.ac.uk/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");

if (!isloggedin() || isguestuser()) {
	return;
}

$indicator_name = required_param('name', PARAM_TEXT);  // indicator required

if ($indicator_name == 'dyslexia_indicator') {
	$course_id = 'WELL.DYSLEX';
	$role = $DB->get_record('role', array('shortname' => 'student'), 'id', MUST_EXIST);
	$sql = 'SELECT c.id'
		. ' FROM {user_enrolments} ue'
		. ' JOIN {enrol} e ON e.id = ue.enrolid'
		. ' JOIN {context} ct ON ct.instanceid = e.courseid'
		. ' JOIN {role_assignments} ra ON ra.contextid = ct.id'
		. ' JOIN {course} c ON c.id = e.courseid'
		. ' WHERE ue.userid = ?'
//			. ' AND (e.enrol = "database" OR e.enrol = "databaseextended" OR e.enrol = "ethos" OR e.enrol = "lmb")'
			. ' AND ct.contextlevel = 50'
			. ' AND ra.userid = ue.userid'
			. ' AND ra.roleid = ?'
			. ' AND c.idnumber = ?';
	$db_ret = $DB->get_records_sql($sql, array($USER->id, $role->id, $course_id));
	if (empty($db_ret)) {
		echo 'N';
	} else {
		echo 'Y';
	}
}

if ($indicator_name == 'F3') {
	$course_id = 'WELL.F3';
	$role = $DB->get_record('role', array('shortname' => 'student'), 'id', MUST_EXIST);
	$sql = 'SELECT c.id'
		. ' FROM {user_enrolments} ue'
		. ' JOIN {enrol} e ON e.id = ue.enrolid'
		. ' JOIN {context} ct ON ct.instanceid = e.courseid'
		. ' JOIN {role_assignments} ra ON ra.contextid = ct.id'
		. ' JOIN {course} c ON c.id = e.courseid'
		. ' WHERE ue.userid = ?'
//			. ' AND (e.enrol = "database" OR e.enrol = "databaseextended" OR e.enrol = "ethos" OR e.enrol = "lmb")'
			. ' AND ct.contextlevel = 50'
			. ' AND ra.userid = ue.userid'
			. ' AND ra.roleid = ?'
			. ' AND c.idnumber = ?';
	$db_ret = $DB->get_records_sql($sql, array($USER->id, $role->id, $course_id));
	if (empty($db_ret)) {
		echo 'N';
	} else {
		echo 'F3';
	}
}

$ext_inds = array('CWON','CWTW','CWTH','CWFO','CWFI');

if 	(in_array($indicator_name,$ext_inds)) { 
	$course_id = 'WELL.' . $indicator_name;
	$role = $DB->get_record('role', array('shortname' => 'student'), 'id', MUST_EXIST);
	$sql = 'SELECT c.id'
		. ' FROM {user_enrolments} ue'
		. ' JOIN {enrol} e ON e.id = ue.enrolid'
		. ' JOIN {context} ct ON ct.instanceid = e.courseid'
		. ' JOIN {role_assignments} ra ON ra.contextid = ct.id'
		. ' JOIN {course} c ON c.id = e.courseid'
		. ' WHERE ue.userid = ?'
//			. ' AND (e.enrol = "database" OR e.enrol = "databaseextended" OR e.enrol = "ethos" OR e.enrol = "lmb")'
			. ' AND ct.contextlevel = 50'
			. ' AND ra.userid = ue.userid'
			. ' AND ra.roleid = ?'
			. ' AND c.idnumber = ?';
	$db_ret = $DB->get_records_sql($sql, array($USER->id, $role->id, $course_id));
	if (empty($db_ret)) {
		echo 'N';
	} else {
		echo $indicator_name;
	}
}
