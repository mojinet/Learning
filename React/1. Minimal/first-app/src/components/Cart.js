import '../styles/Cart.css'

const plants = [
    {name:'monstera', price:8},
    {name:'lierre', price:10},
    {name:'bouquets de fleurs', price:15},
]
function Cart(){
    return <div id="cart">
        <h2>Panier</h2>
        <ul>
            <li> {plants[0].name} : {plants[0].price}€ </li>
            <li> {plants[1].name} : {plants[1].price}€ </li>
            <li> {plants[2].name} : {plants[2].price}€ </li>
        </ul>
        <span>Total: {plants[0].price + plants[1].price + plants[2].price}€ </span>
    </div>
}

export default Cart