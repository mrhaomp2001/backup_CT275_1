<?php

namespace MagicClass;

class CauTraLoi
{
    public $db;

    public $maCauTraLoi;
    public $maCauHoi;
    public $caTraLoiDung;
    public $noiDungTraLoi;
    public $noiDungSauTraLoi;

    public function __construct()
    {
    }

    public function GetByUsername($usernameT)
    {
        $i = 0;
        $list = array();

        $stmt = $this->db->prepare('CALL GETCAUTRALOIBYUSERNAME(?)');

        $stmt->execute(
            [
                $usernameT
            ]
        );

        while ($row = $stmt->fetch()) {
            $CauTraLoi = new CauTraLoi();

            $CauTraLoi->maCauTraLoi = $row['MA_CAU_TRA_LOI'];
            $CauTraLoi->noiDungTraLoi = $row['NOI_DUNG_TRA_LOI'];

            $list[] = $CauTraLoi;
        }


        $stmt->closeCursor();
        return $list;
    }
}
