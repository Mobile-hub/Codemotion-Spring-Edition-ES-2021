import React from "react"

class Genius extends React.Component {

    constructor(props) {
        super(props)

        this.model = {}
        this.state = {
            model_available: false,
            question: 'Where did Tesla born?',
            passage: 'Born and raised in the Austrian Empire, Tesla studied engineering and physics in the 1870s without receiving a\n' +
                '      degree, and gained practical experience in the early 1880s working in telephony and at Continental Edison in the\n' +
                '      new electric power industry. He emigrated in 1884 to the United States, where he would become a naturalized\n' +
                '      citizen. He worked for a short time at the Edison Machine Works in New York City before he struck out on his own.\n' +
                '      With the help of partners to finance and market his ideas, Tesla set up laboratories and companies in New York to\n' +
                '      develop a range of electrical and mechanical devices. His alternating current (AC) induction motor and related\n' +
                '      polyphase AC patents, licensed by Westinghouse Electric in 1888, earned him a considerable amount of money and\n' +
                '      became the cornerstone of the polyphase system which that company would eventually market.',
            responses: []
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() {
        if (typeof window !== 'undefined') {
            window.qna.load().then(model => {
                this.model = model
                this.setState({model_available: true})
            });
        }
    }

    handleChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.setState({
            [name]: value
        });
    }

    handleSubmit(event) {
        event.preventDefault()
        this.model.findAnswers(
            this.state.question,
            this.state.passage)
        .then(answers => {
            debugger
            this.setState({ responses: JSON.stringify(answers) }) })
    }

    render() {
        return (
            <div className="container">
                <form>
                    <div className="row">
                        <label htmlFor="passage">Context</label>
                        <textarea className="u-full-width height-10"
                                  value={this.state.passage}
                                  onChange={this.handleChange}
                                  name="passage"></textarea>
                    </div>
                    <div className="row">
                        <div className="six columns">
                            <label htmlFor="question">Your question</label>
                            <input
                                className="u-full-width"
                                type="text"
                                value={this.state.question}
                                onChange={this.handleChange}
                                name="question" />
                        </div>
                        <div className="six columns"></div>
                    </div>
                    <input
                        disabled={!this.state.model_available}
                        className="button-primary"
                        type="submit"
                        value="Ask model"
                        onClick={this.handleSubmit} />
                </form>

                <div className="row">
                    <label htmlFor="responses">Context</label>
                    <textarea className="u-full-width height-5" defaultValue={this.state.responses} name="responses"></textarea>
                </div>

            </div>

        )
    }
}

export default Genius
