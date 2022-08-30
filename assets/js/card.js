class CardsFrame extends React.Component {
    constructor(props) {
        super(props);
        this.state = {films:props.filmsProps}
    }
    render() {
        return (
            <div className="cardsFrame">
                {
                    this.state.films.map((value,index)=>{
                        return <Card info={value} key={index}/>
                    })
                }
            </div>
        )
    }
}

function Card(props) {
    return (
        <div className="card mb-3">
            <h3 className="card-header" id="title">{props.info.title}</h3>
            <img className="imgFilm" src={props.info.urlFilm} alt=""/>
                <div className="card-body">
                    <p className="card-text" id="plot">{props.info.plot}</p>
                </div>
                <ul className="list-group list-group-flush">
                    <li className="list-group-item" id="year">{props.info.year}</li>
                    <li className="list-group-item" id="genre">{props.info.genres}</li>
                    <li className="list-group-item" id="directors">{props.info.directors}</li>
                    <li className="list-group-item" id="cast">{props.info.cast}</li>
                </ul>
                <button type="button" className="btn btn-secondary">LECTURE</button>
                <button type="button" className="btn btn-danger">AJOUTER A MA LISTE</button>
        </div>
    )
}

ReactDOM.render(<CardsFrame filmsProps={films}></CardsFrame>,document.getElementById('cardsFrame'));