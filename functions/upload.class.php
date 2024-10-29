<?php

/**
 * @author karim salim
 * @copyright 2011
 */
class fileupload_course extends script_course
{
    public function fileupload_process() { 
      $uploadfiles = $_FILES['uploadfiles'];
    
      if (is_array($uploadfiles)) {
    
        foreach ($uploadfiles['name'] as $key => $value) {
    
          // look only for uploded files
          if ($uploadfiles['error'][$key] == 0) { 
    
            $filetmp = $uploadfiles['tmp_name'][$key];
    
            //clean filename and extract extension
            $filename = $uploadfiles['name'][$key];
    
            // get file info
            // @fixme: wp checks the file extension....
            $filetype = wp_check_filetype( basename( $filename ), null );
            $filetitle = preg_replace('/\.[^.]+$/', '', basename( $filename ) );
            $filename = $filetitle . '.' . $filetype['ext'];
            $upload_dir = wp_upload_dir();
    
            /**
             * Check if the filename already exist in the directory and rename the
             * file if necessary
             */
            $i = 0;
            while ( file_exists( $upload_dir['path'] .'/' . $filename ) ) {
              $filename = $filetitle . '_' . $i . '.' . $filetype['ext'];
              $i++;
            }
            $filedest = $upload_dir['path'] . '/' . $filename;
            //POST VARIABLE TO ADD OR UPDATE
            $_POST['upload_path'] = $upload_dir['url'].'/'.$filename;
            /**
             * Check write permissions
             */
            if ( !is_writeable( $upload_dir['path'] ) ) {
              $this->msg_e('Unable to write to directory %s. Is this directory writable by the server?');
              return;
            }
    
            /**
             * Save temporary file to uploads dir
             */
            if ( !@move_uploaded_file($filetmp, $filedest) ){
              $this->msg_e("Error, the file $filetmp could not moved to : $filedest ");
              continue;
            }
    
            $attachment = array(
              'post_mime_type' => $filetype['type'],
              'post_title' => $filetitle,
              'post_content' => '',
              'post_status' => 'inherit'
            );
    
            $attach_id = wp_insert_attachment( $attachment, $filedest );
            require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $filedest );
            wp_update_attachment_metadata( $attach_id,  $attach_data );
          }
        }
      }
    }
}
?>