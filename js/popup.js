const btnOpen = document.querySelectorAll('.testLink')

const popup = document.querySelector('.popUp')

const body = document.body

const popOpen = () => {
  popup.classList.add('popUp--show')
  body.classList.add('body--pop')
}

const popClose = () => {
  popup.classList.remove('popUp--show')
  body.classList.remove('body--pop')
}

btnOpen.forEach((item) => {
  item.addEventListener('click', () => popOpen())
})

popup.addEventListener('click', (event) => {
  const target = event.target
  console.log(target)
  if (target && target.classList.contains('popUp-container') || target.classList.contains('popUp-close-img')) {
    popClose()
  }
})

document.addEventListener('keydown', (event) => {
  if (event.code === "Escape") {
    popClose()
  }
})