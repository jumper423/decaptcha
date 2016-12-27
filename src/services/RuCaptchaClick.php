<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaGrid.
 */
class RuCaptchaClick extends RuCaptchaInstruction
{
    const ACTION_FIELD_COORDINATESCAPTCHA = 19;

    public function init()
    {
        parent::init();

        $this->paramsNames[static::ACTION_FIELD_COORDINATESCAPTCHA] = 'coordinatescaptcha';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_COORDINATESCAPTCHA] = [
            static::PARAM_SLUG_DEFAULT => 1,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
        ];
    }

    /**
     * @return array
     */
    public function getCode()
    {
        $code = parent::getCode();
        $code = explode(':', $code)[1];
        $code = explode(';', $code);
        $result = [];
        foreach ($code as $row) {
            $rowCoord = explode(',', $row);
            foreach ($rowCoord as &$rowCoordOne) {
                $rowCoordOne = substr($rowCoordOne, 2);
            }
            $result[] = $rowCoord;
        }

        return $result;
    }
}
