<?php
namespace App\Classes;
use Exception;
use Illuminate\Contracts\Filesystem\Filesystem;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Aws\S3\S3Client;



class FileUtility {

	private $maxsize = ":6000";
	private $format = "required|mimes:pdf,pf,docx,doc,dotx,dot,docm,dotm,rtf,txt,jpeg,jpg,png,gif,bmp,tiff,raw,webp,heif,heic,ico,tga,pict,exif,cr2,nef,orf|max";
	private $path = "";
	private $s3_url = "";
    private $dir;
    private $bucket = "presteeg";
    private $s3Client = "";
	public function __construct($path = NULL){
        if($path != NULL) {
            $this->path = $path;
        }else {
            $this->path = "files/files/";
        }

        //$this->dir = $directory;
        // $this->s3Client = new S3Client([
        //             'region' => 'us-east-2',
        //             'version' => 'latest',
        //             'credentials' => [
        //                 'key' => 'AKIAJ2SZOYK6GTDEX23A',
        //                 'secret' => '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']
        //             ]);
	}
	// public function uploadImage($request,$obj,$index='files'){
	// 	$obj->validate($request, [
    //         $index => $this->format,
    //     ]);
    //     $image = $request->file($index);
    //     $arr = ['organization_id','group_id','company_id','office_id'];
    //     $name = '';
    //     foreach ($arr as $key => $value) {
    //     	if(isset($user[$value]) && @$user[$value] != 0)
    //     		$name .= $user[$value].'-';
    //     }
    //     $new_name = $name.time().'.'.$image->getClientOriginalExtension();


    //     $image->move($this->path,$new_name);
    //     $up = $this->uploadToS3($this->path.$new_name,$new_name);


    //     return $this->s3_url.$new_name;
	// }
    // public function uploadImageByUrl($url){


    //     $arr = ['organization_id','group_id','company_id','office_id'];
    //     $name = rand();
    //     foreach ($arr as $key => $value) {
    //         if(isset($user[$value]) && @$user[$value] != 0)
    //             $name .= $user[$value].'-';
    //     }
    //     $ext = pathinfo($url, PATHINFO_EXTENSION);
    //     $new_name = $name.time().'.'.$ext;

    //     copy($url,$this->path.$new_name);
    //     $up = $this->uploadToS3($this->path.$new_name,$new_name);
    //     $images = $this->s3_url.$new_name;

    //     $mime_type = mime_content_type($this->path.$new_name);
    //     list($width, $height) = getimagesize($this->path.$new_name);
    //     $nimages['images'] = $images;
    //     $nimages['reso']['media_url'] = $images['orignal'];
    //     $nimages['reso']['mime_type'] = $mime_type;
    //     $nimages['reso']['ext'] = $ext;
    //     $nimages['reso']['ext'] = $ext;
    //     $nimages['reso']['resource_name'] = $ext;
    //     $nimages['reso']['width'] = $width;
    //     $nimages['reso']['size'] = filesize($this->path.$new_name);

    //     $nimages['reso']['height'] = $height;

    //     return $nimages;
    // }
	public function uploadFolioFiles($request,$obj=NULL,$index='files'){
		/*
        VALIDE THE IMAGE WITH FOLLWING EXTENSION AND MAX SIZE
        */
		$obj->validate($request, [
            'files.*' => $this->format.$this->maxsize,
        ]);
        $image = $request->file($index);
        $image = $image[0];

        $name = time().rand().rand();
        $ext = $image->getClientOriginalExtension();
        $mime_type = $image->getMimeType();


        $new_name = $name.'.'.$ext;

        /*
        UPLOAD THE IMAGE TO DESTINATION FOR TEMP
        */
        $images = array("name"=>$name);

        try{
            $image->move($this->path,$new_name);

            //$up = $this->uploadToS3($this->path.$new_name,$new_name);

            $images = array("orignal"=>url($this->path).'/'.$new_name,"name"=>url($this->path).'/'.$new_name);


        }catch(Exception $e){
            die("Uplaod to uplod image".$e);
        }
        $nimages['images'] = $images;
        $nimages['file_orignal_name'] = $image->getClientOriginalName();

        $nimages['reletive_path'] = $this->path.$new_name;
        $nimages['orignal_name'] = $new_name;
        $nimages['reso']['media_url'] = $images['orignal'];
        $nimages['reso']['mime_type'] = $mime_type;
        $nimages['reso']['ext'] = $ext;
        $nimages['reso']['ext'] = $ext;
        $nimages['reso']['resource_name'] = $ext;

        return $nimages;
	}
	function uploadToS3($path = NULL,$new_name){
        if($path != NULL){
        	try{
        		$s3path = $this->dir.$new_name;
                /*$result = $this->s3Client->putObject([
                    'Bucket' => $this->bucket,
                    'Key' => $s3path,
                    'SourceFile' => $this->path.$new_name,
                    'ACL'    => 'public-read',
                    'Tagging' => 'category=temp-upload-file' // your tag here!
                ]);
                return $result['ObjectURL'];*/

                /*Storage::disk('s3')->put($s3path, file_get_contents($path), 'public');
                Storage::disk('s3')->setTagging($s3path, 'category=tag1');
	        	$stored_image = Storage::disk('s3')->url($new_name);
	        	return $stored_image;	*/

                $t = Storage::disk('s3')->put($s3path, file_get_contents($path), 'public');

                $stored_image = Storage::disk('s3')->url($s3path);
                return $stored_image;
        	}catch(Exception $e){
	            die("Uplaod to uplod image".$e);
	        }

        }
    }

}
