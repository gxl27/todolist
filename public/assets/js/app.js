// let btnFinishTask = document.querySelectorAll('.btn-finish-task');

// btnFinishTask.forEach( e => {
//     e.addEventListener('click', () => {
//         let dataId = e.dataset.id;
//         let link = '/item/' + dataId;
//         axios.post(link, 
//             {id : 13}
//             )
//             .then(response => {
//                 console.log(response.data)
//                 // window.location.href = window.location.href;
//             })
//     })
// })

// axios.get(link)
// .then(res =>{
//     console.log(res)
//     if(res.status == 200){

//         location.reload();
//     }else{
//         alert("Error")
//     }
// })   



// flatpickr

const dateInput = document.querySelectorAll(".dateinput");

const calendar = flatpickr(dateInput, {
    altInput: true,
    altFormat: "H:i  |  d F Y",
    dateFormat: "Y-m-d H:i",
    enableTime: true,
    time_24hr: true,
    // minDate: softdate,
    // "locale": "ro",
    // inline: true,
}); 
