"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.getGiff = void 0;
const node_fetch_1 = __importDefault(require("node-fetch"));
const settings_1 = require("./settings");
const getGiff = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const { params } = req;
    const { searchtext, offset } = params;
    try {
        const url = settings_1.giffUrl + '&q=' + searchtext + '&limit=' + settings_1.pageSize + '&offset=' + (offset * settings_1.pageSize);
        const giffRes = yield (0, node_fetch_1.default)(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        const giffs = yield giffRes.json();
        res.json(giffs);
    }
    catch (e) {
        console.error(e);
        res.boom.badImplementation('Failed to get giffs');
    }
});
exports.getGiff = getGiff;
//# sourceMappingURL=giphy.js.map