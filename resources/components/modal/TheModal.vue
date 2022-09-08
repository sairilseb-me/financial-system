<template>
    <div class="modal show" style="display: block" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <slot name="header"></slot>
                    </h5>
                </div>
                <div class="modal-body">
                   <slot name="body"></slot>
                </div>
                <slot name="error"></slot>
                <div class="modal-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
