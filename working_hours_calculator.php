<?php
/**
 * Get the total working hours in seconds between 2 dates..
 * @param DateTime $start Start Date and Time
 * @param DateTime $end Finish Date and Time
 * @param array $working_hours office hours for each weekday (0 Monday, 6 Sunday), Each day must be an array containing a start/finish time in seconds since midnight.
 * @return integer
 * @link https://github.com/RCrowt/working-hours-calculator
 */
function getWorkingHoursInSeconds(DateTime $start, DateTime $end, array $working_hours)
{
	$seconds = 0; // Total working seconds

	// Calculate the Start Date (Midnight) and Time (Seconds into day) as Integers.
	$start_date = clone $start;
	$start_date = $start_date->setTime(0, 0, 0)->getTimestamp();
	$start_time = $start->getTimestamp() - $start_date;

	// Calculate the Finish Date (Midnight) and Time (Seconds into day) as Integers.
	$end_date = clone $end;
	$end_date = $end_date->setTime(0, 0, 0)->getTimestamp();
	$end_time = $end->getTimestamp() - $end_date;

	// For each Day
	for ($today = $start_date; $today <= $end_date; $today += 86400) {

		// Get the current Weekday.
		$today_weekday = date('w', $today);

		// Skip to next day if no hours set for weekday.
		if (!isset($working_hours[$today_weekday][0]) || !isset($working_hours[$today_weekday][1])) continue;

		// Set the office hours start/finish.
		$today_start = $working_hours[$today_weekday][0];
		$today_end = $working_hours[$today_weekday][1];

		// Adjust Start/Finish times on Start/Finish Day.
		if ($today === $start_date) $today_start = min($today_end, max($today_start, $start_time));
		if ($today === $end_date) $today_end = max($today_start, min($today_end, $end_time));

		// Add to total seconds.
		$seconds += $today_end - $today_start;

	}

	return $seconds;

}