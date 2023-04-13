import React, {useState} from "react";
import "./Card.css"

export const handleDeleteSelected = (selectIds) => {
    console.log('entrando aqui sem clicaar??')

    fetch('https://localhost:80/api/products/delete', {
            method: "POST",
            data: {
                ids: {
                    selectIds
                }
            }
        }
    ).then(response => response.json())
        .then(data => console.log(data))
}

function MyCard(props) {
    const [selectIds, setSelectIds] = useState([]);

    const handleMassDelete = (e, id) => {
        console.log(e.target.checked)
        console.log(id)

        if (e.target.checked) {
            setSelectIds([...selectIds, id]);
        } else {
            setSelectIds(selectIds.filter(selectId => selectId !== id));
        }
    }

    const handleDelete = (selectIds) => handleDeleteSelected(selectIds)

    return (
        <div className="col">
            <div className="card text-center">
                <div className="card-body">
                    <div className="row">
                        <input className={"col-2 delete-checkbox"} type={"checkbox"} checked={selectIds.includes(props.id)} onChange={(e) => handleMassDelete(e, props.id)} />
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
                            type={content.type} value={content.value} id={content.id} state={props.state}
                        />
                    ))}
                </div>
            </div>
        ));
    };

    return <div className="container mb-3 mt-3">{renderCards()}</div>;
}