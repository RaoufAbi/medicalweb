document.addEventListener("DOMContentLoaded", function () {
    const updateModal = document.getElementById("UPDATEModal");
    const updateForm = document.getElementById("updateSalleForm");
    let salleID = null;
    const bluer = document.getElementById('AllComp');
    const confirmUpdate = document.getElementById('confirmUpdate');
    const cancelUpdate = document.getElementById('cancelUpdate');


    // عند الضغط على زر التحديث في الجدول
    document.querySelectorAll(".updateSalleBtn").forEach(button => {
        button.addEventListener("click", function () {
            salleID = this.getAttribute("data-Selle_id-update"); // الحصول على ID القاعة

            // إرسال طلب AJAX لجلب بيانات القاعة من الخادم
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../assets/php/phpAjax/GET_Update_salle.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    try {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // إدخال القيم في النموذج
                        document.querySelector("#UPDATEModal input[name='nom_salle']").value = response.nom_salle;
                        document.querySelector("#UPDATEModal input[name='nb_lits']").value = response.nb_lits;

                        // عرض النافذة المنبثقة
                        updateModal.classList.add('active');
                        bluer.classList.add('active');
                    } else {
                        alert("حدث خطأ أثناء التحديث: " + (response.error || "غير معروف"));
                        
                    }}catch (e) {
                        alert("الاستجابة ليست JSON صالحًا: " + xhr.responseText);
                    }
                }
            };
            xhr.send("id=" + salleID);
        });
    });

    // عند تأكيد التحديث
    confirmUpdate.addEventListener("click", function (e) {
        e.preventDefault();

        let formData = new FormData(updateForm);
        formData.append("id", salleID); // إرسال ID القاعة مع البيانات

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../assets/php/phpAjax/Update_salle.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                console.log(xhr.responseText);
                if (response.success) {
                    location.reload(); // إعادة تحميل الصفحة لتحديث الجدول
                } else {
                    alert("حدث خطأ أثناء التحديث.");
                }
            }
        };
        xhr.send(formData);
    });

    // عند الضغط على إلغاء
    cancelUpdate.addEventListener("click", function () {
        updateModal.classList.remove('active');
        bluer.classList.remove('active');
    });
});
