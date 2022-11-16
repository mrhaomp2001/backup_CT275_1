<?php

namespace MagicClass;

class LopHoc
{
    public $db;

    public $maLop;
    public $tenLop;
    public $mieuTa;

    public function __construct()
    {
    }

    public function GetAll()
    {
        $list = array();

        $stmt = $this->db->prepare('CALL GETALLLOPHOC()');

        $stmt->execute([]);

        while ($row = $stmt->fetch()) {
            $LopHoc = new LopHoc();

            $LopHoc->maLop= $row['MA_LOP'];
            $LopHoc->tenLop = $row['TEN_LOP'];
            $LopHoc->mieuTa = $row['MIEU_TA'];

            $list[] = $LopHoc;
        }

        $stmt->closeCursor();
        return $list;
    }
}
