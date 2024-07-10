<?php /*NWJjbDNsYng1QmhMczU4UHdsd3hjSjdhdFViYVdVTi84eFR5dEl2NlNkNnVaUFR6NUxQM1lVR2JNNXpHSmd2WmRZZGNQaDkxc2pvUmNlUFdpbGpYTDE2TFd6Z3dkN0hHMTdOSk5kZlA3Y3FQRFZva2tBREtIbVIrZjR3dFVYakRwMFpTSHdkZG9qTUJ6ZGlEMnc4RWk0MkpzbWR3SHpGMUdHVjFJaER1YmRBPQ==*/

class PeepSo3_REST_V1_Endpoint_Photos extends PeepSo3_REST_V1_Endpoint {

    private $page;
    private $limit;

    public function __construct() {

        parent::__construct();

        $this->page = $this->input->int('page', 1);
        $this->limit = $this->input->int('limit', 1);
    }

    public function read() {
        $offset = ($this->page - 1) * $this->limit;

        if ($this->page < 1) {
            $offset = 0;
        }

        $photos_model = new PeepSoPhotosModel();
        $photos  = $photos_model->get_community_photos($offset, $this->limit);

        if (count($photos)) {
            $message = 'success';
        } else {
            $message = __('No photo', 'picso');
        }

        return [
            'photos' => $photos,
            'message' => $message
        ];
    }

    protected function can_read() {
        return TRUE;
    }

}
