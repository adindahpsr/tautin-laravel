document.addEventListener("DOMContentLoaded", () => {
    // ========= [Navbar Toggle] =========
    const navButton = document.querySelector("#nav-menu-button");
    const navUl = document.querySelector(".nav-ul");

    if (navButton) {
        navButton.addEventListener("click", () => {
            navUl.classList.toggle("hide-ul");
        });
    }

    // ========= [Short Link Form] =========
    const shortLinkForm = document.querySelector("#form-data");
    const getLinkBtn = document.querySelector("#btn");
    const outputContainer = document.querySelector("#output");
    const outputLink = document.querySelector("#shortened-link");
    const qrImage = document.getElementById("qr-code");
    const downloadQrBtn = document.getElementById("download-qr");
    const copyShortBtn = document.querySelector("#copy");

    if (getLinkBtn && shortLinkForm) {
        getLinkBtn.addEventListener("click", function (e) {
            e.preventDefault();

            const url = shortLinkForm.getAttribute("action");
            const data = $(shortLinkForm).serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    if (response.link) {
                        outputLink.href = response.link;
                        outputLink.textContent = response.link;
                        outputContainer.classList.remove("hidden");

                        if (qrImage && response.qr_code) {
                            qrImage.src = response.qr_code;
                            qrImage.classList.remove("hidden");
                            qrImage.style.opacity = "0";
                            setTimeout(() => {
                                qrImage.style.opacity = "1";
                            }, 10);
                        }

                        if (downloadQrBtn && response.qr_code) {
                            downloadQrBtn.classList.remove("hidden");
                        }

                        $("html, body").animate(
                            {
                                scrollTop: $("#output").offset().top - 100,
                            },
                            500
                        );

                        showToast("Tautan berhasil dibuat!", "#90C67C");
                    } else {
                        handleError("Gagal membuat tautan!");
                    }
                },
                error: function (xhr) {
                    console.log("XHR error:", xhr);
                    let message = "Terjadi kesalahan, coba lagi!";
                    if (xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        try {
                            const json = JSON.parse(xhr.responseText);
                            if (json.message) message = json.message;
                        } catch (_) {}
                    }
                    handleError(message);
                },
            });
        });
    }

    if (copyShortBtn) {
        copyShortBtn.addEventListener("click", () => {
            if (outputLink?.textContent?.trim()) {
                navigator.clipboard.writeText(outputLink.textContent)
                    .then(() => showToast("Tautan disalin!", "#2196F3"))
                    .catch(err => console.error("Gagal menyalin: ", err));
            } else {
                handleError("Tidak ada tautan untuk disalin!");
            }
        });
    }

    if (downloadQrBtn) {
        downloadQrBtn.addEventListener("click", () => {
            if (qrImage?.src) {
                const a = document.createElement("a");
                a.href = qrImage.src;
                a.download = "QR_Code.png";
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        });
    }

    // =====================================
    // Self-Destruct Message Form Handling
    // =====================================

    const form = document.querySelector("#message-form");
    const messageLink = document.querySelector("#message-link");
    const linkContainer = document.querySelector("#link-container");
    const copyBtn = document.querySelector("#copy-btn");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData,
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Gagal membuat pesan.");
                }
                return response.json();
            })
            .then((data) => {
                messageLink.href = data.link;
                messageLink.innerText = data.link;
                linkContainer.style.display = "block";
                showToast("Pesan berhasil dibuat!", "#90C67C");
            })
            .catch((error) => {
                showToast(error.message || "Terjadi kesalahan.", "#f44336");
            });
        });

        copyBtn.addEventListener("click", () => {
            if (messageLink.href) {
                navigator.clipboard.writeText(messageLink.href).then(() => {
                    showToast("Tautan disalin!", "#2196F3");
                });
            }
        });
    }

    // ========= [Util: Toast & Error Handling] =========
    function handleError(message) {
        showToast(message, "#d9534f");
    }

    function showToast(text, bgColor) {
        Toastify({
            text: text,
            duration: 3000,
            gravity: "bottom",
            position: "center",
            stopOnFocus: true,
            style: { background: bgColor },
        }).showToast();
    }
});
