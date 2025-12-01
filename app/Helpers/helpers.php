<?php

use App\Helpers\FormatHelper;
use App\Helpers\ApiHelper;
use App\Helpers\KeysHelper;
use App\Helpers\ValidatorHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\RecordingHelper;
use App\Helpers\ComponentHelper;
use Carbon\Carbon;

function formatHelper() {
    return new FormatHelper();
}

function apiHelper() {
    return new ApiHelper();
}

function keysHelper() {
    return new KeysHelper();
}

function validatorHelper() {
    return new ValidatorHelper();
}

function globalHelper() {
    return new GlobalHelper();
}

function responseHelper() {
    return new ResponseHelper();
}

function logInfo(string $message) {
    return globalHelper()->logInfo($message);
}

function recordingHelper() {
    return new RecordingHelper();
}

function componentHelper() {
    return new ComponentHelper();
}

/**
 * Format date with timezone support
 * 
 * @param string|Carbon|null $date The date to format
 * @param string $format The date format (default: 'm/d/Y H:i')
 * @param string|null $timezone The timezone to use (default: app timezone)
 * @return string Formatted date string
 */
function formatDateWithTimezone($date, string $format = 'm/d/Y H:i', ?string $timezone = null): string {
    return FormatHelper::formatDateWithTimezone($date, $format, $timezone);
}

/**
 * Format current date/time with timezone
 * 
 * @param string $format The date format (default: 'm/d/Y H:i')
 * @param string|null $timezone The timezone to use (default: app timezone)
 * @return string Formatted date string
 */
function formatNow(string $format = 'm/d/Y H:i', ?string $timezone = null): string {
    return FormatHelper::formatNow($format, $timezone);
}