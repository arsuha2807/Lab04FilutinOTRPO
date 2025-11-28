import '../scss/styles.scss';
import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  // Показ toast при клике на кнопку с классом header-button
  const headerBtn = document.querySelector('.header-button');
  if (headerBtn) {
    headerBtn.addEventListener('click', () => {
      const toast = new bootstrap.Toast(document.getElementById('liveToast'));
      toast.show();
    });
  }

  // Навешиваем событие перехода на кнопку с ID btn-upload (добавьте id кнопке)
  const btnUpload = document.getElementById('btn-upload');
  if (btnUpload) {
    btnUpload.addEventListener('click', () => {
      window.location.href = 'http://127.0.0.1:8000/cards';
    });
  }

  // Инициализация popover
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
  [...popoverTriggerList].forEach(el => new bootstrap.Popover(el));

  // Инициализация модалок и навигация через клавиши
  const buttons = document.querySelectorAll('.card .btn[data-bs-toggle="modal"]');
  const modals = [...buttons].map(btn => document.querySelector(btn.dataset.bsTarget));
  const bootstrapModals = modals.map(modal => new bootstrap.Modal(modal));

  let currentIndex = -1;

  modals.forEach((modal, index) => {
    modal.addEventListener('show.bs.modal', () => {
      currentIndex = index;
    });
  });

  document.addEventListener('keydown', e => {
    if (currentIndex === -1) return;
    let nextIndex = currentIndex;
    if (e.key === 'ArrowRight') {
      nextIndex = (currentIndex + 1) % modals.length;
    } else if (e.key === 'ArrowLeft') {
      nextIndex = (currentIndex - 1 + modals.length) % modals.length;
    } else {
      return;
    }
    bootstrapModals[currentIndex].hide();
    modals[currentIndex].addEventListener('hidden.bs.modal', () => {
      bootstrapModals[nextIndex].show();
    }, { once: true });
  });
});
