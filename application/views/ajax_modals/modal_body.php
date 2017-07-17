<style media="screen">
.myIfrm{ width:70%; height:550px;}
</style>

<div class="row">
    <div class="col-sm-6">
        <?php
        switch ($file_path_org_type) {
            case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            case "application/msword":
            case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
            case "application/vnd.ms-powerpointtd":
            case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
            case "application/vnd.ms-excel":
            case "application/powerpoint":
                ?>
                <iframe class="myIfrm" src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $file_path_org; ?>'
                        frameborder='0'></iframe>
                <?php
                break;

            case "application/pdf":
                ?>
                <iframe class="myIfrm" src="https://docs.google.com/gview?url=<?php echo $file_path_org; ?>&embedded=true"
                        frameborder="0"></iframe>
                <?php
                break;

            case "text/x-comma-separated-values": ?>
                <iframe class="myIfrm" src='http://datapipes.okfnlabs.org/csv/html/?url=<?php echo base_url('uploads/'.$file_path_org) ?>' frameborder='0'></iframe>
                <?php
                break;

            case "image/bmp":
            case "image/gif":
            case "image/jpeg":
            case "image/jpg":
            case "image/png":
                ?>
                <div id="over">
                    <img style="height:550px;" class="img-responsive" src="<?php echo $file_path_org ?>"/>
                </div>
                <?php
                break;

            default:
                ?>
                <div id="over">
                    No preview available
                </div>
                <?php
                // force download
                // header('Pragma: public');
                // header('Expires: 0');
                // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                // header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime (base_url('uploads/'.$document))).' GMT');
                // header('Cache-Control: private',false);
                // header('Content-Type: '.$file_type);
                // header('Content-Disposition: attachment; filename="'.basename($file_info['name']).'"');
                // header('Content-Transfer-Encoding: binary');
                // header('Content-Length: '.$file_info['size']);
                // header('Connection: close');
                // readfile(base_url('uploads/'.$document));
                // exit();
                break;
        }
        ?>
    </div>
    <div class="col-sm-6">
        <?php
        switch ($file_path_trans_type) {
            case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            case "application/msword":
            case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
            case "application/vnd.ms-powerpointtd":
            case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
            case "application/vnd.ms-excel":
            case "application/powerpoint":
                ?>
                <iframe class="myIfrm" src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $file_path_trans ?>'
                        frameborder='0'></iframe>
                <?php
                break;

            case "application/pdf":
                ?>
                <iframe class="myIfrm" src="https://docs.google.com/gview?url=<?php echo $file_path_trans ?>&embedded=true"
                        frameborder="0"></iframe>
                <?php
                break;

            case "text/x-comma-separated-values": ?>
                <iframe class="myIfrm" src='http://datapipes.okfnlabs.org/csv/html/?url=<?php echo base_url('uploads/'.$file_path_trans) ?>' frameborder='0'></iframe>
                <?php
                break;


            case "image/bmp":
            case "image/gif":
            case "image/jpeg":
            case "image/jpg":
            case "image/png":
                ?>
                <div id="over">
                    <img style="height:550px; width: 80%; " class="img-responsive" src="<?php echo $file_path_trans ?>"/>
                </div>
                <?php
                break;

            default:
                ?>
                <div id="over">
                    No preview available
                </div>
                <?php
                // force download
                // header('Pragma: public');
                // header('Expires: 0');
                // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                // header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime (base_url('uploads/'.$document))).' GMT');
                // header('Cache-Control: private',false);
                // header('Content-Type: '.$file_type);
                // header('Content-Disposition: attachment; filename="'.basename($file_info['name']).'"');
                // header('Content-Transfer-Encoding: binary');
                // header('Content-Length: '.$file_info['size']);
                // header('Connection: close');
                // readfile(base_url('uploads/'.$document));
                // exit();
                break;
        }
        ?>
    </div>
</div>