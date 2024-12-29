// الغرض: تأكيد حذف الصفوف

function confirmation(event, gradeId) {
    event.preventDefault(); // منع الإرسال الفوري للنموذج
    Swal.fire({
        title: translations.confirmDeleteTitle, // استخدام الترجمة
        text: translations.confirmDeleteText, // استخدام الترجمة
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: translations.confirmButton, // استخدام الترجمة
        cancelButtonText: translations.cancelButton // استخدام الترجمة
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`formExlu${gradeId}`).submit();
            Swal.fire({
                title: translations.successTitle, // استخدام الترجمة
                text: translations.successMessage, // استخدام الترجمة
                icon: "success",
                timer: 10000,
                timerProgressBar: false,
                showConfirmButton: false
            });
        }
    });
}

function editGrade(event, gradeId) {
    event.preventDefault(); // منع الإرسال الفوري للنموذج

    // جلب النموذج
    const form = document.getElementById(`formEdit${gradeId}`);
    const nameAr = form.querySelector('input[name="Name"]').value || ''; // التحقق من وجود القيمة
    const nameEn = form.querySelector('input[name="Name_en"]').value || ''; // التحقق من وجود القيمة
    const notes = form.querySelector('input[name="Notes"]').value || ''; // التحقق من وجود القيمة

    // نافذة SweetAlert2 لتحرير البيانات
    Swal.fire({
        title: translations.editGradeTitle, // استخدام الترجمة من `translations`
        html: `
            <form id="editForm">
                <div class="d-flex justify-content-between">
                    <div class="form-group text-left" style="width: 48%; font-size: 18px; font-family: Arial, sans-serif;">
                        <label>${translations.stageNameAr}:</label>
                        <input type="text" id="editNameAr" class="form-control" value="${nameAr}" style="font-size: 16px; padding: 10px;" required>
                    </div>
                    <div class="form-group text-left" style="width: 48%;font-size: 18px; font-family: Arial, sans-serif;">
                        <label>${translations.stageNameEn}:</label>
                        <input type="text" id="editNameEn" class="form-control" value="${nameEn}" style="font-size: 16px; padding: 10px;" required>
                    </div>
                </div>
                <div class="form-group text-left mt-3">
                    <label>${translations.notesLabel}:</label>
                    <textarea id="editNotes" class="form-control" rows="3" style="font-size: 16px;">${notes}</textarea>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: translations.saveChanges, // استخدام الترجمة
        cancelButtonText: translations.cancelButton, // استخدام الترجمة
        focusConfirm: false,
        customClass: {
            popup: 'custom-swal-popup', // نفس فئة التخصيص المستخدمة في addGrade
            htmlContainer: 'custom-html-container' // نفس فئة HTML
        },
        preConfirm: () => {
            const newNameAr = document.getElementById('editNameAr').value.trim();
            const newNameEn = document.getElementById('editNameEn').value.trim();
            const newNotes = document.getElementById('editNotes').value.trim();

            if (!newNameAr || !newNameEn || !newNotes) {
                Swal.showValidationMessage(translations.validationMessage); // استخدام الترجمة
                return false;
            }

            // تحديث القيم داخل النموذج المخفي
            form.querySelector('input[name="Name"]').value = newNameAr;
            form.querySelector('input[name="Name_en"]').value = newNameEn;
            form.querySelector('input[name="Notes"]').value = newNotes;

            // إرسال النموذج
            form.submit();
        }
    });
}

function addGrade() {
    Swal.fire({
        title: translations.addGradeTitle, // استخدام الترجمة
        html: `
            <form id="addForm">
                <div class="d-flex justify-content-between">
                    <div class="form-group text-left" style="width: 48%; font-size: 18px; font-family: Arial, sans-serif;">
                        <label>${translations.stageNameAr}:</label>
                        <input type="text" id="addNameAr" class="form-control" style="font-size: 16px; padding: 10px;" required>
                    </div>
                    <div class="form-group text-left" style="width: 48%; font-size: 18px; font-family: Arial, sans-serif;">
                        <label>${translations.stageNameEn}:</label>
                        <input type="text" id="addNameEn" class="form-control" style="font-size: 16px; padding: 10px;" required>
                    </div>
                </div>
                <div class="form-group text-left mt-3" font-size: 18px; font-family: Arial, sans-serif;">
                    <label>${translations.notesLabel}:</label>
                    <textarea id="addNotes" class="form-control" rows="3" style="font-size: 16px; padding: 10px;" required></textarea>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: translations.saveChanges, // نص زر الإضافة
        cancelButtonText: translations.cancelButton, // نص زر الإلغاء
        focusConfirm: false,
        customClass: {
            popup: 'custom-swal-popup', // إضافة فئة مخصصة
            htmlContainer: 'custom-html-container' // فئة للـ HTML الداخلي
        },
        preConfirm: () => {
            // الحصول على القيم المدخلة من الحقول
            const nameAr = document.getElementById('addNameAr').value.trim();
            const nameEn = document.getElementById('addNameEn').value.trim();
            const notes = document.getElementById('addNotes').value.trim();

            if (!nameAr || !nameEn || !notes) {
                Swal.showValidationMessage(translations.validationMessage); // رسالة التحقق
                return false;
            }

            // تحديث القيم داخل النموذج المخفي
            const form = document.getElementById('formAddGrade');
            if (form) {
                form.querySelector('input[name="Name"]').value = nameAr;
                form.querySelector('input[name="Name_en"]').value = nameEn;
                form.querySelector('input[name="Notes"]').value = notes;

                // إرسال النموذج
                form.submit();
            } else {
                console.error("Form 'formAddGrade' not found.");
            }
        }
    });
}

