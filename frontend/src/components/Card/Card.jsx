import React, {useState} from "react";
import "./Card.css"

function MyCard(props) {
    return (
        <div className="col">
            <div className="card text-center">
                <div className="card-body">
                    <div className="row">
                        <input className={"col-2 delete-checkbox"} type={"checkbox"} onChange={() => props.handleMassDelete(props.id)} />
                        <h5 className="card-title col-8">{props.sku}</h5>
                    </div>
                    <h6 className="card-subtitle mb-1 mt-2 text-body-secondary">Name: {props.name}</h6>
                    <p className="card-text">Price: ${props.price}</p>
                    <p className="card-text">{props.type}</p>
                    <p className="card-text">{props.value}</p>
                </div>
            </div>
        </div>
    )
}

export default function Card(props) {
    const {data} = props
    const [ids, setIds] = useState([])

    const handleMassDelete = (id) => {
        if (ids.includes(id)) {
            setIds(ids.filter(item => item !== id))
        } else {
            setIds([...ids, id])
        }

        props.handleSelectedIds(id)
    }

    const renderCards = () => {
        const rows = [];

        for (let i = 0; i < data.length; i += 3) {
            const row = data.slice(i, i + 3);
            rows.push(row);
        }

        return rows.map((row, index) => (
            <div key={index} className={"row"}>
                <div className={"row"}>
                    {row.map((content) => (
                        <MyCard
                            key={content.id} sku={content.sku} name={content.name} price={content.price}
                            type={content.type} value={content.value} id={content.id} handleMassDelete={handleMassDelete}
                        />
                    ))}
                </div>
            </div>
        ));
    };

    return <div className="container mb-3 mt-3">{renderCards()}</div>;
}