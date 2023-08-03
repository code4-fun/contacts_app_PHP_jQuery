$(document).ready(function(){
  $(document).on('click', '.delete-button-block', function(e){
    deleteContact(e.currentTarget.dataset.id)
  })
})

// Create contact
function createContact(data){
  clearErrors()
  const name = data.get('name')
  const phone = data.get('phone')
  if(name === ''){
    $('.contact-errors').append('<div>Заполните имя</div>')
    return
  }
  if(phone === ''){
    $('.contact-errors').append('<div>Заполните телефон</div>')
    return
  }
  $.ajax({
    url: "/contacts/add",
    type: 'POST',
    data: {
      name: name,
      phone: phone
    }
  }).done((data) => {
    if(data){
      data = JSON.parse(data)
      const noteList = $('.contact_container')
      if(noteList){
        noteList.find(">:first-child").next().before($(listItem(data)).hide().delay(200).show('slow'))
      }
      removeFormValues()
    }
  })
  removeFormValues()
}

// Delete contact and remove it from the list
function deleteContact(id){
  $.ajax({
    url: `/contacts/delete/${id}`,
    type: 'POST',
    data: {
      id: id
    }
  }).done(() => {
    $('#contact_' + id).hide('slow')
  })
}

// Remove errors in the form
function clearErrors(){
  $('.contact-errors').children().remove()
}

// Clear form
function removeFormValues(){
  $('.contact-input').val('')
  clearErrors()
}

// List item to append after ajax query
function listItem(data){
  return `      <div class=\'contact_item\' id="contact_${data.id}">\n` +
    '             <div class=\'contact_body\'>\n' +
    `               <div class=\'contact_name\'>${data.name}</div>\n` +
    `               <div class=\'delete-button-block\' data-id="${data.id}">\n` +
    '                 <div class=\'delete-button\'></div>\n' +
    '               </div>\n' +
    '             </div>\n' +
    `             <div class=\'contact_phone\'>${data.phone}</div>\n` +
    '           </div>'
}
