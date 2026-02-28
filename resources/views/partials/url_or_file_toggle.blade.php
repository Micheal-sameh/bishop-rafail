@once
    <script>
        (function () {
            if (window.__urlFileToggleInitialized) {
                return;
            }

            window.__urlFileToggleInitialized = true;

            window.bindUrlFileToggle = function (urlId, fileId) {
                var urlInput = document.getElementById(urlId);
                var fileInput = document.getElementById(fileId);

                if (!urlInput || !fileInput) {
                    return;
                }

                function hasFile() {
                    return fileInput.files && fileInput.files.length > 0;
                }

                function syncState() {
                    var hasUrl = String(urlInput.value || '').trim().length > 0;
                    var hasUploadedFile = hasFile();

                    fileInput.disabled = hasUrl;
                    urlInput.disabled = hasUploadedFile;
                }

                urlInput.addEventListener('input', syncState);
                fileInput.addEventListener('change', syncState);
                syncState();
            };
        })();
    </script>
@endonce

<script>
    window.bindUrlFileToggle(@json($urlId), @json($fileId));
</script>
