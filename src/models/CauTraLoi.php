<?php

namespace MagicClass;

class CauTraLoi
{
    public $db;

    public $maCauTraLoi;
    public $maCauHoi;
    public $cauTraLoiDung;
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

    public function GetByMaCauHoi($maCauHoiT)
    {
        $i = 0;
        $list = array();

        $stmt = $this->db->prepare('CALL GETCAUTRALOIBYMACAUHOI(?)');

        $stmt->execute(
            [
                $maCauHoiT
            ]
        );

        while ($row = $stmt->fetch()) {
            $CauTraLoi = new CauTraLoi();

            $CauTraLoi->maCauTraLoi = $row['MA_CAU_TRA_LOI'];
            $CauTraLoi->maCauHoi = $row['MA_CAU_HOI'];
            $CauTraLoi->noiDungTraLoi = $row['NOI_DUNG_TRA_LOI'];
            $CauTraLoi->noiDungSauTraLoi = $row['NOI_DUNG_SAU_TRA_LOI'];
            $CauTraLoi->cauTraLoiDung = $row['CAU_TRA_LOI_DUNG'];

            $list[] = $CauTraLoi;
        }


        $stmt->closeCursor();
        return $list;
    }
}
