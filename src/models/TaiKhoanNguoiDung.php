<?php

namespace MagicClass;

class TaiKhoanNguoiDung
{
    private $db;

    public $username;
    public $maLoaiTaiKhoan;
    public $tenLoaiTaiKhoan;
    public $maLop;
    public $tenLop;
    public $maNguoiDung;
    public $tenNguoiDung;
    public $doDoi;
    public $tien;
    public $kinhNghiem;
    public $maCauHoi;


    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function FindByUsername($usernameT)
    {
        $stmt = $this->db->prepare('CALL FINDTAIKHOANNGUOIDUNGBYUSERNAME(?)');

        $stmt->execute(
            [
                $usernameT
            ]
        );

        if ($row = $stmt->fetch()) {
            $this->username = $row['USERNAME'];
            $this->maLoaiTaiKhoan = $row['MA_LOAI_TAI_KHOAN'];
            $this->tenLoaiTaiKhoan = htmlspecialchars($row['TEN_LOAI_TAI_KHOAN']);
            $this->maNguoiDung = $row['MA_NGUOI_DUNG'];
            $this->tenNguoiDung = htmlspecialchars($row['TEN_NGUOI_DUNG']);
            $this->doDoi = $row['DO_DOI'];
            $this->tien = $row['TIEN'];
            $this->kinhNghiem = $row['KINH_NGHIEM'];
            $this->maLop = $row['MA_LOP'];
            $this->tenLop = htmlspecialchars($row['TEN_LOP']);
            $this->maCauHoi = $row['MA_CAU_HOI'];
        }
        $stmt->closeCursor();
        return $this;
    }

    public function Add($usernameT, $passwordT, $nameT)
    {
        $stmt = $this->db->prepare('CALL REGISTER(?, ?, ?)');

        $stmt->execute(
            [
                $usernameT,
                $passwordT,
                $nameT
            ]
        );

        if ($row = $stmt->fetch()) {
        }
        $stmt->closeCursor();
        return $this;
    }

    public function FindByUsernameMODERATOR()
    {
        $list = array();
        $stmt = $this->db->prepare('CALL FINDTAIKHOANNGUOIDUNGMODERATOR()');

        $stmt->execute(
            []
        );

        while ($row = $stmt->fetch()) {

            $user = new TaiKhoanNguoiDung($this->db);

            $user->username = $row['USERNAME'];
            $user->maLoaiTaiKhoan = $row['MA_LOAI_TAI_KHOAN'];
            $user->tenLoaiTaiKhoan = htmlspecialchars($row['TEN_LOAI_TAI_KHOAN']);
            $user->maNguoiDung = $row['MA_NGUOI_DUNG'];
            $user->tenNguoiDung = htmlspecialchars($row['TEN_NGUOI_DUNG']);
            $user->doDoi = $row['DO_DOI'];
            $user->tien = $row['TIEN'];
            $user->kinhNghiem = $row['KINH_NGHIEM'];
            $user->maLop = $row['MA_LOP'];
            $user->tenLop = htmlspecialchars($row['TEN_LOP']);
            $user->maCauHoi = $row['MA_CAU_HOI'];

            $list[] = $user;
        }
        $stmt->closeCursor();
        return $list;
    }
}
