document.addEventListener("DOMContentLoaded", function () {
    const deleteModal = document.getElementById('deleteModal');
    const bluer = document.getElementById('AllComp');

    // استخدم متغير لتخزين حالة النموذج
    let isProcessing = false;

    // عند تقديم النموذج
    document.getElementById("formPatient").addEventListener("submit", function (e) {
        e.preventDefault();

        // منع إرسال البيانات إذا كانت العملية قيد المعالجة
        if (isProcessing) {
            return;
        }

        isProcessing = true; // وضع العلامة بأن العملية قيد المعالجة

        let formData = new FormData(this);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../assets/php/phpAjax/get_Infos.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById("medecinSelected").innerText = "الطبيب المختار: " + response.medecin;
                    document.getElementById("salleSelected").innerText = "القسم المختار: " + response.salle;
                    document.getElementById("bedSelected").innerText = "السرير المختار: " + response.bed;
                    bluer.classList.add('active');
                    deleteModal.classList.add('active');

                    // حفظ القيم لاستخدامها لاحقًا عند التأكيد
                    document.getElementById("confirmDelete").setAttribute("data-medecin", response.medecin);
                    document.getElementById("confirmDelete").setAttribute("data-salle", response.salle_id);
                    document.getElementById("confirmDelete").setAttribute("data-bed", response.bed);
                }

                isProcessing = false; // إعادة تعيين العملية عند الانتهاء
            }
        };
        xhr.send(formData);
    });

    // عند الضغط على "تأكيد الحذف"
    document.getElementById("confirmDelete").addEventListener("click", function () {
        // تحقق من المتغيرات المحفوظة
        let medecinID = this.getAttribute("data-medecin");
        let bedID = this.getAttribute("data-bed");

        // الحصول على بيانات النموذج
        let form = document.getElementById("formPatient");
        let formData = new FormData(form);

        // إضافة medecinID و bedID إلى بيانات النموذج
        formData.append("medecinID", medecinID);
        formData.append("bedID", bedID);

        // إرسال البيانات إلى الخادم
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../assets/php/phpAjax/addPatient.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.href = "patients.php";
                } else {
                    alert("حدث خطأ أثناء إدخال البيانات.");
                }

                isProcessing = false; // إعادة تعيين العملية عند الانتهاء
            }
        };
        xhr.send(formData);
    });
});


    