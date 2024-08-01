<?php

namespace App\Http\Controllers;


use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class UploadDocumentController extends Controller
{
    private $type = "Documents";
    private $singular = "Document";
    private $plural = "Documents";
    private $view = "dashboard.documents.upload";
    private $action = "document";
    private $db_key = "emp_id";

    private $maxsize = ":6000";
    private $format = "required|mimes:pdf,zip,pf,docx,doc,dotx,dot,docm,dotm,rtf,txt,jpeg,jpg,png,gif,bmp,tiff,raw,webp,heif,heic,ico,tga,pict,exif,cr2,nef,orf";
    private $extensionToImage = [
        'docx' => 'docx-file-icon.jpg',
        'doc' => 'for-doc.svg',
        'txt' => 'for-txt.svg',
        'zip' => 'for-zip.svg',
        'pdf' => 'for-pdf.svg',
        'png' => 'for-png.svg',
        'html' => 'for-html.svg',
        'jpg' => 'for-jpg.svg',
        'jpeg' => 'image-file-icon.png',
        'svg' => 'image-file-icon.png',
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $files = File::where('user_id', $id)->get();
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("/dashboard" => 'Dashboard', "/dashboard/document" => $this->plural),
            "action" => url('dashboard/' . $this->action),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'dashboard/' . $this->action, 'db_key' => $this->db_key],
            "active_module" => "users",
            "files" => $files,
            "extensionToImage" => $this->extensionToImage,
        );
        return view('dashboard.documents.upload', $data);
    }



    public function upload(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'multifiles.*' => $this->format . '|' . $this->maxsize,
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        $user_id = Auth::user()->id;

        if ($request->file('multifiles')) {
            foreach ($request->file('multifiles') as $image) {
                $originalName = $image->getClientOriginalName();
                $filename = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $destinationPath = 'files/';
                $filepath = $destinationPath . time() . rand() . rand() . '.' . $extension;
                Storage::disk('public')->put($filepath, file_get_contents($image));
                File::create([
                    'user_id' => $user_id,
                    'file_path' => $filepath,
                    'file_name' => $filename,
                    'file_extension' => $extension,
                ]);
            }
        }

        return response()->json('successs');
    }

    public function destroy($files)
    {
        $files_array = explode(',', $files);
        foreach ($files_array as $file) {
            $file_found = File::find($file);
            if ($file_found) {
                Storage::disk('public')->delete($file_found->file_path);
                $file_found->delete();
            }
        }
        return response()->json('success');
    }

    public function rename(Request $request)
    {
        $file = File::find($request->image);
        $file->update([
            'file_name' => $request->name,
        ]);

        return response()->json('success');
    }

    function unsetValue(array $array, $value, $strict = TRUE)
    {
        if (($key = array_search($value, $array, $strict)) !== FALSE) {
            unset($array[$key]);
        }
        return $array;
    }


    public function downloadZip($files)
    {
        $fileUrls = explode(',', $files);
        $tempDir = storage_path('app/temp_zip');

        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Download each file and save it to the temporary directory
        foreach ($fileUrls as $fileUrl) {
            $fileContent = Storage::get('public/files/' . $fileUrl);
            $fileName = basename($fileUrl);
            file_put_contents($tempDir . '/' . $fileName, $fileContent);
        }

        // Create a zip archive
        $zipFileName = 'downloaded_files.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);
        $zip = new ZipArchive();
        $zip->open($zipFilePath, ZipArchive::CREATE);

        // Add files to the zip archive
        foreach (glob($tempDir . '/*') as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();

        // Remove temporary directory
        $this->rrmdir($tempDir);

        // Provide a link to download the zip file
        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }

    private function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $this->rrmdir("$dir/$file");
                }
            }
            rmdir($dir);
        } elseif (file_exists($dir)) {
            unlink($dir);
        }
    }

    public function fetchFiles(Request $request){

        $files = File::where('user_id',Auth::user()->id)->get();

        return response()->json([
            'files' => $files,
            'extensionToImage' => $this->extensionToImage
        ]);
    }

   

    public function serchFiles(Request $request){
        $files = File::where('file_name','like','%'.$request->keyword.'%')->get();
        return response()->json([
            'files' => $files,
            'extensionToImage' => $this->extensionToImage
        ]);
    }
}
