<?php

namespace MagicClass;

class CauHoi
{
    private $db;

    public $maCauHoi;
    public $maLop;
    public $noiDungCauHoi;
    public $tienCauHoi;
    public $kinhNgiem;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function GetByUsername($usernameT)
    {
        $stmt = $this->db->prepare('CALL GETCAUHOIHIENTAIBYUSERNAME(?)');

        $stmt->execute(
            [
                $usernameT
            ]
        );

        if ($row = $stmt->fetch()) {
            $this->maCauHoi = $row['MA_CAU_HOI'];
            $this->noiDungCauHoi = $row['NOI_DUNG_CAU_HOI'];
            $this->tienCauHoi = $row['TIEN_CAU_HOI'];
            $this->kinhNgiem = $row['KINH_NGHIEM_CAU_HOI'];
        }
        $stmt->closeCursor();
        return $this;
    }

    public function GetByMaLop($maLopT)
    {
        $list = array();
        $stmt = $this->db->prepare('CALL GETCAUHOIBYMALOP(?)');

        $stmt->execute(
            [
                $maLopT
            ]
        );

        while ($row = $stmt->fetch()) {
            $cauHoi = new CauHoi($this->db);

            $cauHoi->maCauHoi = $row['MA_CAU_HOI'];
            $cauHoi->noiDungCauHoi = $row['NOI_DUNG_CAU_HOI'];
            $cauHoi->tienCauHoi = $row['TIEN_CAU_HOI'];
            $cauHoi->kinhNgiem = $row['KINH_NGHIEM_CAU_HOI'];
            
            $list[] = $cauHoi;
        }
        $stmt->closeCursor();
        return $list;
    }
}
