<style media="screen">
    html, body, iframe {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }

    #over img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<?php
include('database.php');

function getFileMimeType($file)
{
    if (function_exists('finfo_file')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($finfo, $file);
        finfo_close($finfo);
    } else {
        require_once 'upgradephp/ext/mime.php';
        $type = mime_content_type($file);
    }

    if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
        $secondOpinion = exec('file -b --mime-type ' . escapeshellarg($file), $foo, $returnCode);
        if ($returnCode === 0 && $secondOpinion) {
            $type = $secondOpinion;
        }
    }

    if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
        require_once 'upgradephp/ext/mime.php';
        $exifImageType = exif_imagetype($file);
        if ($exifImageType !== false) {
            $type = image_type_to_mime_type($exifImageType);
        }
    }

    return $type;
}


$type = $_GET['type'];          // regular, review
$id = (int)$_GET['id'];      // proofread_job_doc_id, job_id
$field = $_GET['field'];        // original_file, translated_file, file
$url = (isset($_GET['url'])) ? $_GET['url'] : "";

$base = '';
$base = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base .= "://" . $_SERVER['HTTP_HOST'];
$base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$base .= '../';
$documents = null;


if ($type == 'review') {
    $sql = "SELECT original_file, translated_file FROM proofread_jobs_docs WHERE id = {$id}";
    $query = mysql_query($sql);

    if (mysql_num_rows($query)) {
        $rows = mysql_fetch_assoc($query);

        if (isset($rows[$field])) {
            $file = str_replace(' ', '_', $rows[$field]);
            $file_path = dirname(__FILE__) . '/../uploads/review/' . $file;
            $file_type = getFileMimeType($file_path);
            $file_info = pathinfo($file_path);
            $file_size = filesize($file_path);

            $document['document'] = 'review/' . $file;
            $document['file_type'] = $file_type;
            $document['file_info']['name'] = $file_info['basename'];
            $document['file_info']['size'] = $file_size;
        }

        $documents[] = $document;
    } else {
        // redirect
    }
}
// echo 'INFO: <pre>'; print_r($documents);
// echo '***END***'; exit;

if (count($documents)) {
    foreach ($documents as $document) {
        ?>
        <div class="row">
            <div class="col-md-12" style="padding:10px; margin-left: 15px;">
                <a href="<?php echo $base . 'uploads/' . $document['document'] ?>" class="btn btn-app btn-lg">Download
                    this file</a>
            </div>
        </div>
        <div class="col-sm-12">
            <?php
            switch ($document['file_type']) {
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                case "application/msword":
                case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
                case "application/vnd.ms-powerpointtd":
                case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                case "application/vnd.ms-excel":
                case "application/powerpoint":
                case "application/zip":
                    ?>
                    <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $base . 'uploads/' . $document['document'] ?>'
                            frameborder='0'></iframe>
                    <?php
                    break;

                case "application/pdf":
                    ?>
                    <iframe src="https://docs.google.com/gview?url=<?php echo $base . 'uploads/' . $document['document'] ?>&embedded=true"
                            frameborder="0"></iframe>
                    <?php
                    break;

                case "text/x-comma-separated-values": ?>
                    <iframe class="myIfrm"
                            src='http://datapipes.okfnlabs.org/csv/html/?url=<?php echo $base . 'uploads/' . $document['document']; ?>'
                            frameborder='0'></iframe>
                    <?php
                    break;

                case "image/bmp":
                case "image/gif":
                case "image/jpeg":
                case "image/jpg":
                case "image/png":
                    ?>
                    <div id="over">
                        <img class="img-reponsive" style="max-height: 400px"
                             src="<?php echo $base . 'uploads/' . $document['document'] ?>"/>
                    </div>
                    <?php
                    break;

                default:
                    ?>
                    <div id="over" style="position:absolute; width:100%; height:100%">
                        <div style="width: 200px; margin: auto; font-size: 18px; font-weight: bold; padding-top: 10%;">
                            No preview available
                        </div>
                    </div>
                    <?php
                    // force download
//                header('Pragma: public');
//                header('Expires: 0');
//                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//                header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime (base_url('uploads/'.$document['document']))).' GMT');
//                header('Cache-Control: private',false);
//                header('Content-Type: '.$document['file_type']);
//                header('Content-Disposition: attachment; filename="'.basename($document['file_info']['name']).'"');
//                header('Content-Transfer-Encoding: binary');
//                header('Content-Length: '.$document['file_info']['size']);
//                header('Connection: close');
//                readfile(base_url('uploads/'.$document['document']));
//                exit();
                    break;
            } ?>
        </div>
    <?php }
} elseif ($url != '') {
    $file_array = explode('/', $url);
    $filename = end($file_array);
    $dirname = prev($file_array);
    $file = str_replace(' ', '_', $filename);
    $file_path = dirname(__FILE__) . '/uploads/' . $dirname . '/' . $file;
    $file_type = getFileMimeType($file_path);
    $file_info = pathinfo($file_path);
    $file_size = filesize($file_path);
    $document['document'] = $dirname . '/' . $file;
    $document['file_type'] = $file_type;
    $document[' case "application/powerpoint":']['name'] = $file_info['basename'];
    $document['file_info']['size'] = $file_size;
    $documents[] = $document;
    foreach ($documents as $document) {
        ?>
        <div class="row">
            <div class="col-md-12" style="padding:10px; margin-left: 15px;">
                <a href="<?php echo $base . 'chat-box/uploads/' . $document['document'] ?>" class="btn btn-app btn-lg">Download
                    this file</a>
            </div>
        </div>
        <div class="col-sm-12">
            <?php
            switch ($document['file_type']) {
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                case "application/msword":
                case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
                case "application/vnd.ms-powerpointtd":
                case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                case "application/vnd.ms-excel":
                case "application/excel":
                case "application/powerpoint":
                case "application/zip":
                    ?>
                    <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $base . 'chat-box/uploads/' . $document['document'] ?>'
                            frameborder='0'></iframe>
                    <?php
                    break;

                case "application/pdf":
                    ?>
                    <iframe src="https://docs.google.com/gview?url=<?php echo $base . 'chat-box/uploads/' . $document['document'] ?>&embedded=true"
                            frameborder="0"></iframe>
                    <?php
                    break;

                case "text/x-comma-separated-values": ?>
                    <iframe class="myIfrm"
                            src='http://datapipes.okfnlabs.org/csv/html/?url=<?php echo $base . 'chat-box/uploads/' . $document['document'] ?>'
                            frameborder='0'></iframe>
                    <?php
                    break;

                case "image/bmp":
                case "image/gif":
                case "image/jpeg":
                case "image/jpg":
                case "image/png":
                    ?>
                    <div id="over">
                        <img class="img-responsive" style="max-height: 400px"
                             src="<?php echo $base . 'chat-box/uploads/' . $document['document'] ?>"/>
                    </div>
                    <?php
                    break;

                default:
                    ?>
                    <div id="over">
                        <div style="width: 200px; margin: auto; font-size: 18px; font-weight: bold; padding-top: 10%;">
                            No preview available
                        </div>
                    </div>
                    <?php
                    // force download
//
                    break;
            } ?>

        </div>
    <?php }
}
?>
