<?php

/**
 * Created by PhpStorm.
 * User: smykruslanal
 * Date: 01.08.2018
 * Time: 15:27
 */

namespace App\Structure\Lottery;

use JMS\Serializer\Annotation as Serializer;

class ParticipantStructure
{
    /**
     * @var int
     * @Serializer\SerializedName("rank")
     * @Serializer\Type("integer")
     */
    public $rank;

    /**
     * @var int
     * @Serializer\SerializedName("playerUUID")
     * @Serializer\Type("integer")
     */
    public $playerUUID;

    /**
     * @var  string
     * @Serializer\SerializedName("userName")
     * @Serializer\Type("string")
     */
    public $userName;

    /**
     * @var int
     * @Serializer\SerializedName("sumAmount")
     * @Serializer\Type("integer")
     */
    public $sumAmount;

    /**
     * @var int
     * @Serializer\SerializedName("ticketCount")
     * @Serializer\Type("integer")
     */
    public $ticketCount;
}
