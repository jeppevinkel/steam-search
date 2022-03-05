<?php

/**
 * This file is part of the steam-search package.
 *
 * (c) Jeppe Vinkel Beier <jeppe@beiernet.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SteamSearch\Models;

class VRSupport
{
    public bool $vrOnly = false;
    public bool $vrSupported = false;

    public bool $valveIndex = false;
    public bool $htcVive = false;
    public bool $oculusRift = false;
    public bool $windowsMixedReality = false;

    public bool $trackedMotionControllers = false;
    public bool $gamepad = false;
    public bool $keyboardMouse = false;

    public bool $seated = false;
    public bool $standing = false;
    public bool $roomScale = false;

    public function __construct(array $data = null)
    {
        if (!$data) return;

        $this->vrOnly = $data['vr_only'] ?? false;
        $this->vrSupported = $data['vr_supported'] ?? false;

        $this->valveIndex = $data['valve_index'] ?? false;
        $this->htcVive = $data['htc_vive'] ?? false;
        $this->oculusRift = $data['oculus_rift'] ?? false;
        $this->windowsMixedReality = $data['windows_mixed_reality'] ?? false;

        $this->trackedMotionControllers = $data['tracked_motion_controllers'] ?? false;
        $this->gamepad = $data['gamepad'] ?? false;
        $this->keyboardMouse = $data['keyboard_mouse'] ?? false;

        $this->seated = $data['seated'] ?? false;
        $this->standing = $data['standing'] ?? false;
        $this->roomScale = $data['room_scale'] ?? false;
    }

    public function setVrOnly(bool $vrOnly)
    {
        $this->vrOnly = $vrOnly;
    }

    public function setVrSupported(bool $vrSupported)
    {
        $this->vrSupported = $vrSupported;
    }

    public function setValveIndex(bool $valveIndex)
    {
        $this->valveIndex = $valveIndex;
    }

    public function setHtcVive(bool $htcVive)
    {
        $this->htcVive = $htcVive;
    }

    public function setOculusRift(bool $oculusRift)
    {
        $this->oculusRift = $oculusRift;
    }

    public function setWindowsMixedReality(bool $windowsMixedReality)
    {
        $this->windowsMixedReality = $windowsMixedReality;
    }

    public function setTrackedMotionControllers(bool $trackedMotionControllers)
    {
        $this->trackedMotionControllers = $trackedMotionControllers;
    }

    public function setGamepad(bool $gamepad)
    {
        $this->gamepad = $gamepad;
    }

    public function setKeyboardMouse(bool $keyboardMouse)
    {
        $this->keyboardMouse = $keyboardMouse;
    }

    public function setSeated(bool $seated)
    {
        $this->seated = $seated;
    }

    public function setStanding(bool $standing)
    {
        $this->standing = $standing;
    }

    public function setRoomScale(bool $roomScale)
    {
        $this->roomScale = $roomScale;
    }

    public function getVrOnly()
    {
        return $this->vrOnly;
    }

    public function getVrSupported()
    {
        return $this->vrSupported;
    }

    public function getValveIndex()
    {
        return $this->valveIndex;
    }

    public function getHtcVive()
    {
        return $this->htcVive;
    }

    public function getOculusRift()
    {
        return $this->oculusRift;
    }

    public function getWindowsMixedReality()
    {
        return $this->windowsMixedReality;
    }

    public function getTrackedMotionControllers()
    {
        return $this->trackedMotionControllers;
    }

    public function getGamepad()
    {
        return $this->gamepad;
    }

    public function getKeyboardMouse()
    {
        return $this->keyboardMouse;
    }

    public function getSeated()
    {
        return $this->seated;
    }

    public function getStanding()
    {
        return $this->standing;
    }

    public function getRoomScale()
    {
        return $this->roomScale;
    }

    /**
     * Returns the string representation of this object or null if it is empty.
     * @return string|null
     */
    public function toQueryString(): ?string
    {
        $query = [
            $this->vrOnly ? '401' : '',
            $this->vrSupported ? '402' : '',

            $this->valveIndex ? '105' : '',
            $this->htcVive ? '101' : '',
            $this->oculusRift ? '102' : '',
            $this->windowsMixedReality ? '104' : '',

            $this->trackedMotionControllers ? '201' : '',
            $this->gamepad ? '202' : '',
            $this->keyboardMouse ? '203' : '',

            $this->seated ? '301' : '',
            $this->standing ? '302' : '',
            $this->roomScale ? '303' : '',
        ];

        $string = implode(',', array_filter($query));

        if (empty($string)) return null;
        return $string;
    }
}