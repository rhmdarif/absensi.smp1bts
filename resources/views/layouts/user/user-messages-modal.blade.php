
    <!-- DialogIconedSuccess -->
    <div class="modal fade dialogbox" id="DialogIconedSuccess" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-success">
                    <ion-icon name="checkmark-circle"></ion-icon>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                </div>
                <div class="modal-body">
                    This is a dialog message
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * DialogIconedSuccess -->

    <!-- DialogIconedDanger -->
    <div class="modal fade dialogbox" id="DialogIconedDanger" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-danger">
                    <ion-icon name="close-circle"></ion-icon>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                </div>
                <div class="modal-body">
                    This is a dialog message
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * DialogIconedDanger -->
    <!-- DialogIconedInfo -->
    <div class="modal fade dialogbox" id="DialogIconedInfo" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-info">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">In Proccess</h5>
                </div>
                <div class="modal-body">
                    This is a dialog message
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * DialogIconedInfo -->

            <!-- CONFIRM DIALOG -->
            <div class="modal fade dialogbox" id="dialogConfirmation" data-backdrop="static" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">KONFIRMASI!</h5>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin melakukan ini?
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn btn-text-secondary" data-dismiss="modal">TIDAK</a>
                                <a href="#" class="btn btn-text-primary yes">IYA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONFIRM DIALOG -->

    <script>
        const DIALOG_SUCCESS = $('#DialogIconedSuccess');
        const DIALOG_DANGER = $('#DialogIconedDanger');
        const DIALOG_INFO = $('#DialogIconedInfo');
        const DIALOG_CONFIRM = $('#dialogConfirmation');

        function confirm_box(ref, teks) {
            DIALOG_CONFIRM.find('.yes').attr('onclick', "callback_delete_activity()");
            DIALOG_CONFIRM.find('.media-body').html(teks);
            DIALOG_CONFIRM.modal('show');
        }

    </script>
