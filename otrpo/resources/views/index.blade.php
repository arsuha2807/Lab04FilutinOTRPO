<!DOCTYPE html>
<html lang="ru">
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ОТРПО_2_Филюиин</title>
        <script src="https://unpkg.com/lodash@4.17.20"></script>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ mix('css/styles.css') }}" rel="stylesheet">

    </head>
    <body>
      <main class="flex-grow-1">  <!-- ← растягивает контент -->
    <div class="container">
      @yield('content')  <!-- карточки -->
    </div>
  </main>
<script src="{{ mix('js/main.js') }}" defer></script>
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d8572a; padding: 0;">
            <div class="container-fluid" style="padding: 0 1rem;"> <!-- только внутренние отступы -->
              <a class="navbar-brand" href="#">
                <img src="https://free-png.ru/wp-content/uploads/2022/09/free-png.ru-107.png" alt="Логотип" width="30" height="30">
              </a>
              <span class="header-text" style="color: white; margin-left: 10px;">Персонажи из аниме Наруто</span>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <button id="btn-upload" class="btn btn-primary header-button">Меню</button>
                </li>
              </ul>
            </div>
          </div>
        </nav>
   

<div class="container py-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-3 row-cols-xxxl-4 gx-3 gy-4">
    @foreach($cards as $card)
      <div class="col ">
        <div class="card h-100">
          @if($card->image)
            <img src="{{ asset('storage/' . $card->image) }}" class="card-img-top img-fluid" alt="{{ $card->title }}">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $card->title }}</h5>
            <p class="card-text"> {{ \Illuminate\Support\Str::limit($card->description, 20, '...') }}</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCard{{ $card->id }}">
              Подробнее
            </button>
          </div>
        </div>
      </div>

      <!-- Модальное окно карточки -->
      <div class="modal fade" id="modalCard{{ $card->id }}" tabindex="-1" aria-labelledby="modalCardLabel{{ $card->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCardLabel{{ $card->id }}">{{ $card->title }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
              @if($card->image)
                <img src="{{ asset('storage/' . $card->image) }}" class="img-fluid mb-3" alt="{{ $card->title }}">
              @endif
              <p>{{ $card->description }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>




<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" style="max-width: 300px;">
    <div class="d-flex">
      <div class="me-3 d-flex align-items-center">
        <i class="fas fa-spinner fa-spin fa-2x"></i>
      </div>
      <div class="toast-body">
        Загрузка...
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>



  <!-- Footer -->
  <footer class="text-center py-4 text-white">
    <div>Филютин Арсений</div>
    <div class="mt-2">
      <button class="footer-button me-2"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f3/VK_Compact_Logo_%282021-present%29.svg" width="30" alt="Vk"></button>
      <button class="footer-button me-2"><img src="https://pngicon.ru/file/uploads/telegram-256x256.png" width="30" alt="Tg"></button>
      <button class="footer-button"><img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png" width="40" alt="YT"></button>
    </div>
  </footer>
  <script src="main.js"></script>
</body>
</html>



