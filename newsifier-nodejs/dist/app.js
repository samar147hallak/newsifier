"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const giphy_1 = require("./giphy");
const app = (0, express_1.default)();
const port = 3000;
const cors = require('cors');
app.use(cors());
const router = express_1.default.Router();
router.route('/giffs/:searchtext/:offset').get(giphy_1.getGiff);
app.use(router);
app.get('/', (req, res) => {
    res.send('Giphy App Is Running!');
});
app.listen(port, () => {
    return console.log(`Express is listening at http://localhost:${port}`);
});
//# sourceMappingURL=app.js.map