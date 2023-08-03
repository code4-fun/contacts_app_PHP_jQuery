<?php require APPROOT.'/views/parts/header.php'; ?>

<div class="form_frame">
  <div class="contact-errors"></div>
  <div class="form_container">
    <div class="form_header">Добавить контакт</div>
    <div class="form_body">
      <form class="contact-form" onsubmit="event.preventDefault(); createContact(new FormData(this))">
        <input class="contact-input" name="name" placeholder='Имя' autocomplete='off' />
        <input class="contact-input" name="phone" placeholder='Телефон' autocomplete='off' />
        <button class="contact-button">Добавить</button>
      </form>
    </div>
  </div>
</div>

<div class="contact_list">
  <div class="contact_container">
    <div class="contact_header">Список контактов</div>
    <?php foreach($data['contacts'] as $contact): ?>
      <div class='contact_item' id="contact_<?= $contact->id ?>">
        <div class='contact_body'>
          <div class='contact_name'><?= $contact->name ?></div>
          <div class="delete-button-block" data-id="<?= $contact->id ?>">
            <div class="delete-button"></div>
          </div>
        </div>
        <div class="contact_phone"><?= $contact->phone ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require APPROOT.'/views/parts/footer.php'; ?>
