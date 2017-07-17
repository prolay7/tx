<?php $this->load->view('vwHeader'); ?>
<style media="screen">
    html, body {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }

    .myIfrm {
        width: 100%;
        height: 450px;
    }

    #over img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-download {
        margin: 20px auto;
        border-bottom: 3px solid transparent;
        text-align: center;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="container" style="margin-bottom: 30px">
            <?php
            if (count($documents)) {
                foreach ($documents as $document) {
                    ?>
                    <div class="col-sm-3 text-center">
                        <a href="<?php echo base_url('uploads/' . $document['document']) ?>" class="btn btn-download">Download
                            File</a>
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
                                ?>
                                <iframe class="myIfrm"
                                        src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url('uploads/' . $document['document']) ?>'
                                        frameborder='0'></iframe>

                                <?php
                                break;

                            case "application/pdf":
                                ?>
                                <iframe class="myIfrm" src="<?php echo base_url('uploads/' . $document['document']) ?>"
                                        frameborder="0"></iframe>
                                <?php
                                break;

                            case "text/x-comma-separated-values": ?>
                                <iframe class="myIfrm"
                                        src='http://datapipes.okfnlabs.org/csv/html/?url=<?php echo base_url('uploads/' . $document['document']) ?>'
                                        frameborder='0'></iframe>
                                <?php
                                break;

                            case "image/bmp":
                            case "image/gif":
                            case "image/jpeg":
                            case "image/jpg":
                            case "image/png":
                                ?>
                                <img src="<?php echo base_url('uploads/' . $document['document']) ?>"
                                     class="img-responsive" style="margin-bottom: 20px">
                                <?php
                                break;

                            default:
                                ?>
                                <p style="width: 200px; margin: auto; font-size: 18px; font-weight: bold; padding-top: 10%;">
                                    No preview available
                                </p>
                                <?php
                                // force download
                                // header('Pragma: public');
                                // header('Expires: 0');
                                // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                                // header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime (base_url('uploads/'.$document['document']))).' GMT');
                                // header('Cache-Control: private',false);
                                // header('Content-Type: '.$document['file_type']);
                                // header('Content-Disposition: attachment; filename="'.basename($document['file_info']['name']).'"');
                                // header('Content-Transfer-Encoding: binary');
                                // header('Content-Length: '.$document['file_info']['size']);
                                // header('Connection: close');
                                // readfile(base_url('uploads/'.$document['document']));
                                // exit();
                                break;
                        } ?>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
</div>
<?php
$this->load->view('vwFooter');
$this->load->view('vwFooterLower');
?>
