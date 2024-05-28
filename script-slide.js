class ProductSlider extends React.Component {
  constructor(props) {
    super(props);

    this.IMAGE_PARTS = 4;

    this.changeTO = null;
    this.AUTOCHANGE_TIME = 4000;

    this.state = { activeSlide: -1, prevSlide: -1, sliderReady: false };
  }

  componentWillUnmount() {
    window.clearTimeout(this.changeTO);
  }

  componentDidMount() {
    this.runAutochangeTO();
    setTimeout(() => {
      this.setState({ activeSlide: 0, sliderReady: true });
    }, 0);
  }

  runAutochangeTO() {
    this.changeTO = setTimeout(() => {
      this.changeSlides(1);
      this.runAutochangeTO();
    }, this.AUTOCHANGE_TIME);
  }

  changeSlides(change) {
    window.clearTimeout(this.changeTO);
    const { length } = this.props.slides;
    const prevSlide = this.state.activeSlide;
    let activeSlide = prevSlide + change;
    if (activeSlide < 0) activeSlide = length - 1;
    if (activeSlide >= length) activeSlide = 0;
    this.setState({ activeSlide, prevSlide });
  }


  redirectToInicioPage() {
    window.location.href = 'productos.php';
  }

  render() {
    const { activeSlide, prevSlide, sliderReady } = this.state;
    return (
      React.createElement("div", { className: classNames('slider', { 's--ready': sliderReady }) },
      React.createElement("p", { className: "slider__top-heading" }, ""),
      React.createElement("div", { className: "slider__slides" },
      this.props.slides.map((slide, index) =>
      React.createElement("div", {
        className: classNames('slider__slide', { 's--active': activeSlide === index, 's--prev': prevSlide === index }),
        key: slide.name },

      React.createElement("div", { className: "slider__slide-content" },
      React.createElement("h3", { className: "slider__slide-subheading" }, slide.availability || slide.name),
      React.createElement("h2", { className: "slider__slide-heading" },
      slide.name.split('').map(l => React.createElement("span", null, l))),

      React.createElement("a", { className: "slider__slide-readmore", onClick: this.redirectToInicioPage }, "Read More")
              ),
              React.createElement("div", { className: "slider__slide-parts" },

      React.createElement("p", { className: "slider__slide-readmore" }, "read more")),

      React.createElement("div", { className: "slider__slide-parts" },
      [...Array(this.IMAGE_PARTS).fill()].map((x, i) =>
      React.createElement("div", { className: "slider__slide-part", key: i },
      React.createElement("div", { className: "slider__slide-part-inner", style: { backgroundImage: `url(${slide.img})` } }))))))),


      React.createElement("div", { className: "slider__control", onClick: () => this.changeSlides(-1) }),
      React.createElement("div", { className: "slider__control slider__control--right", onClick: () => this.changeSlides(1) })));


  }}


const slides = [
{
  name: 'ElRinconEnchilado',
  availability: 'Cra15#16-b',
  img: 'https://hips.hearstapps.com/hmg-prod/images/mejores-restaurantes-mexicanos-moda-ticui-1675079095.jpg?crop=1xw:1xh;center,top&resize=980:*' },

{
  name: 'Tacos Picantes Elquetzal',
  availability: 'Cra36#5-A',
  img: 'https://media-cdn.tripadvisor.com/media/photo-w/12/d4/b6/73/la-taqueria-calle-116.jpg' },

{
  name: 'Fijistas Aztecas',
  availability: 'Clle45#3-C!',
  img: 'https://i0.wp.com/foodandpleasure.com/wp-content/uploads/2022/10/mejores-restaurantes-para-comer-mole-cdmx-azul.jpg?w=1280&ssl=1' },

];



ReactDOM.render(React.createElement(ProductSlider, { slides: slides }), document.querySelector('#app'));