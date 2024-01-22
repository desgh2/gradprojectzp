<div>
    <div class="container">
        <h1 class="page-title">Зворотній зв’язок</h1>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <p class="feedback-text mb-3">
                    Звертаємо увагу, що зазначена форма зв'язку призначена для більш мобільного зв'язку з працівниками
                    комунального підприємства.
                </p>
                <p class="feedback-text-required mb-5">
                    <span class="text-warning">*</span> - поля, обов’язкові для заповнення
                </p>
                <form action="" class="row" id="feedback-form" enctype="multipart/form-data">
                    <div class="col-lg-8">
                        <div class="form-floating mb-5">
                            <input type="text" class="form-control input-field" id="name" placeholder="Ім`я">
                            <label for="name">Ім`я <span class="text-warning">*</span></label>
                        </div>
                        <div class="form-floating mb-5">
                            <input type="text" class="form-control input-field" id="phone" placeholder="Телефон">
                            <label for="phone">Телефон</label>
                        </div>
                        <div class="form-floating mb-5">
                            <input type="email" class="form-control input-field" id="email" placeholder="E-mail">
                            <label for="email" class="form-label">E-mail <span class="text-warning">*</span></label>
                        </div>
                        <div class="form-floating mb-5">
                            <textarea class="form-control text-field" id="text" placeholder="Текст повідомлення"></textarea>
                            <label for="text" class="form-label">Текст повідомлення <span
                                    class="text-warning">*</span></label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ff-uploads">
                            <label for="files" class="btn-file-upload">
                                <i class="bi bi-paperclip"></i> Прикріпити файл
                            </label>
                            <input type="file" class="input-file-upload" name="files[]" id="files"
                                multiple="">
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <button class="btn btn-primary btn-feedback">Відправити</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
