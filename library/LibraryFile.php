<?php
	class LibraryFile{
		//upload ảnh
		public function uploadFile($inputName){
			$arHinh = explode('.', $inputName);
			$duoifile = end($arHinh);
			$time = time();
			$tenhinhmoi = 'VNE' .$time . '.' .$duoifile;
			$tmp_name = $_FILES['hinhanh']['tmp_name'];
			$path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenhinhmoi;
			$result_upload = move_uploaded_file($tmp_name, $path_upload); 
			if($result_upload){
				return $tenhinhmoi;
			}else{
				return false;
			}
		}
		//xóa ảnh
		public function deleteFile($fileName){
			unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' .$fileName);
		}
	}
?>