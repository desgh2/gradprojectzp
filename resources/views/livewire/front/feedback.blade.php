<div>
    <div class="container">
        <h1 class="page-title">Зворотній зв’язок</h1>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                @if ($show_message)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Дякуємо за Ваше звернення. Ми відповімо якомога швидше.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <p class="feedback-text mb-3">
                    Звертаємо увагу, що зазначена форма зв'язку призначена для більш мобільного зв'язку з працівниками
                    комунального підприємства.
                </p>
                <p class="feedback-text-required mb-5">
                    <span class="text-warning">*</span> - поля, обов’язкові для заповнення
                </p>
                <form wire:submit="send" class="row" id="feedback-form">
                    <div class="col-lg-8">
                        <div class="form-floating mb-5">
                            <input type="text" class="form-control @error('name') is-invalid @enderror input-field"
                                wire:model="name" id="name" placeholder="Ім`я">
                            <label for="name">Ім`я <span class="text-warning">*</span></label>
                        </div>
                        <div class="form-floating mb-5">
                            <input type="text" class="form-control input-field" wire:model="phone" id="phone"
                                placeholder="Телефон">
                            <label for="phone">Телефон</label>
                        </div>
                        <div class="form-floating mb-5">
                            <input type="email" class="form-control @error('email') is-invalid @enderror input-field"
                                wire:model="email" id="email" placeholder="E-mail">
                            <label for="email" class="form-label">E-mail <span class="text-warning">*</span></label>
                        </div>
                        <div class="form-floating mb-5">
                            <textarea class="form-control @error('text') is-invalid @enderror text-field" wire:model="text" id="text"
                                placeholder="Текст повідомлення"></textarea>
                            <label for="text" class="form-label">Текст повідомлення <span
                                    class="text-warning">*</span></label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="uploads">
                            <input type="file" id="uploadFile{{ $files_count }}" class="input-file" wire:model="files" multiple>
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <button class="btn btn-primary btn-feedback" type="submit">Відправити</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
