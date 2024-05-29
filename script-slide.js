class ProductSlider extends React.Component {
  constructor(props) {
    super(props);

    this.IMAGE_PARTS = 4;

    this.changeTO = null;
    this.AUTOCHANGE_TIME = 4000;

    this.state = { slides: [], activeSlide: -1, prevSlide: -1, sliderReady: false };
  }

  componentWillUnmount() {
    window.clearTimeout(this.changeTO);
  }

  componentDidMount() {
    fetch('getRestaurantes.php')
      .then(response => response.json())
      .then(data => {
        const slides = data.map(restaurante => ({
          name: restaurante.Nombre,
          availability: restaurante.Direccion,
          img: 'https://i0.wp.com/foodandpleasure.com/wp-content/uploads/2022/10/mejores-restaurantes-para-comer-mole-cdmx-azul.jpg?w=1280&ssl=1'
        }));
        this.setState({ slides, activeSlide: 0, sliderReady: true });
      })
      .catch(error => console.error('Error al obtener los datos de los restaurantes:', error));

    this.runAutochangeTO();
  }

  runAutochangeTO() {
    this.changeTO = setTimeout(() => {
      this.changeSlides(1);
      this.runAutochangeTO();
    }, this.AUTOCHANGE_TIME);
  }

  changeSlides(change) {
    window.clearTimeout(this.changeTO);
    const { length } = this.state.slides;
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
    const { slides, activeSlide, prevSlide, sliderReady } = this.state;
    return (
      React.createElement("div", { className: classNames('slider', { 's--ready': sliderReady }) },
        React.createElement("p", { className: "slider__top-heading" }, ""),
        React.createElement("div", { className: "slider__slides" },
          slides.map((slide, index) =>
            React.createElement("div", {
              className: classNames('slider__slide', { 's--active': activeSlide === index, 's--prev': prevSlide === index }),
              key: slide.name
            },
              React.createElement("div", { className: "slider__slide-content" },
                React.createElement("h3", { className: "slider__slide-subheading" }, slide.availability || slide.name),
                React.createElement("h2", { className: "slider__slide-heading" },
                  slide.name.split('').map(l => React.createElement("span", null, l))
                ),
                React.createElement("a", { className: "slider__slide-readmore", onClick: this.redirectToInicioPage }, "Read More")
              ),
              React.createElement("div", { className: "slider__slide-parts" },
                React.createElement("p", { className: "slider__slide-readmore" }, "read more")
              ),
              React.createElement("div", { className: "slider__slide-parts" },
                [...Array(this.IMAGE_PARTS).fill()].map((x, i) =>
                  React.createElement("div", { className: "slider__slide-part", key: i },
                    React.createElement("div", { className: "slider__slide-part-inner", style: { backgroundImage: `url(${slide.img})` } })
                  )
                )
              )
            )
          )
        ),
        React.createElement("div", { className: "slider__control", onClick: () => this.changeSlides(-1) }),
        React.createElement("div", { className: "slider__control slider__control--right", onClick: () => this.changeSlides(1) })
      )
    );
  }
}

ReactDOM.render(React.createElement(ProductSlider, null), document.querySelector('#app'));
