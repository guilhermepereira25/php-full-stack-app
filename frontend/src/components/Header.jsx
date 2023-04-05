import React from "react";


function Text(props) {
    return (
        <>
            <p className="text-uppercase">{ props.text }</p>
        </>
    )
}

export default function Header() {
    return(
        <div className="container text-center">
            <div className="row align-content-between">
                <div className="col">
                    <Text text="Teste props" />
                </div>
                <div className="col">
                    <Text text="Teste props" />
                </div>
                <div className="col">
                    <Text text="Teste props" />
                </div>
            </div>
        </div>
    )
}