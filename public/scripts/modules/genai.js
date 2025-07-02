
import { GoogleGenAI } from "./@google/genai";

// export async function runSearch(search = "") {
//     const ai = new GoogleGenAI({ apiKey: "AIzaSyBiXFVPhl8rh1v4LXlDvUL1XSTuU-ZJYqo" });
//     const response = await ai.models.generateContent({
//         model: "gemini-2.0-flash",
//         contents: search,
//     });
//     return response.text;
// }

async function runSearch() {
    console.log("Run Search");

    // const ai = new GoogleGenAI({ apiKey: "AIzaSyBiXFVPhl8rh1v4LXlDvUL1XSTuU-ZJYqo" });
    // const response = await ai.models.generateContent({
    //     model: "gemini-2.0-flash",
    //     contents: search,
    // });
    
    // console.log(response.text);
    // return response.text;

    
}

export function main() {
    console.log("test");
    runSearch();
}