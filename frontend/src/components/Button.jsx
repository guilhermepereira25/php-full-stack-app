import React from "react";
import {handleDeleteSelected} from "./Card/Card";

function DeleteButton() {
    return (
        <>
            <button className="btn btn-outline-danger" onClick={handleDeleteSelected}>Mass Delete</button>
        </>
    )
}

export default DeleteButton;