import React from "react";
import { useParams } from "react-router-dom";
import axios from "axios";

function withParams(Component) {
  return (props) => <Component {...props} params={useParams()} />;
}

class PlayerResume extends React.Component {
  constructor(props) {
    super(props);
    this.state = { isLoading: true, persons: undefined };
  }

  componentDidMount() {
    const { pseudo } = this.props.params;
    axios.get(`http://127.0.0.1:8000/games/${pseudo}`).then((response) => {
      console.log(response.data);
      this.setState({ persons: response.data });
      this.setState({ isLoading: false });
    });
  }

  render() {
    const { isLoading, persons } = this.state;

    if (isLoading) {
      return <div className="App">Loading...</div>;
    }

    return (
      <div className="App">
        <h1>{persons.matchs[1].Matchid}</h1>
        {/* <li>{this.state.persons.matchs[1].Matchid}</li> */}
        {/* <img alt={persons.name} src={persons.sprites.front_default} /> */}
      </div>
    );
  }
}

export default withParams(PlayerResume);
